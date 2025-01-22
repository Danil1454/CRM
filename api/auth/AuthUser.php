<?php session_start();

// Вход по логину / паролю админа 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Если username есть - записываем username , иначе null
    $login =  isset($_POST['username']) ? $_POST['username'] : '';
    // Если password есть - записываем password , иначе null
    $password = isset ($_POST['password']) ? $_POST['password'] : '';

   // Проверяем пришли ли данные 
   if ($login) {
     $_SESSION['login-errors']['login'] = '' ;
   }
   if ($password) {
     $_SESSION['password-errors']['password'] = '';
   }
   
   if (!$login || !$password) {
       header('Location: ../../login.php');
       exit;
   }
   
   // Если ошибок нет, можно продолжить выполнение кода (например, проверка учетных данных)
   
   
   // Напишите функцию для фильтрации данных 
   function clearData ($input) {
    $cleaned = strip_tags($input);
    $cleaned = trim($cleaned);
    $cleaned = preg_replace('/\s+/',' ', $cleaned);
    return $cleaned;

   }
      
  // Проверка логина 
   require_once '../db.php';
  // 1. Запрос пользователя по логину + вывод что пришло 
  $userID = $db->query(
    "SELECT id FROM users WHERE login='$login' 
    ")->fetchAll(); 

    if (empty($userID)){
        $_SESSION['login-errors']['login'] = 'User not found';
        header ('Location: ../../login.php');
        exit;
    }


    // Сделать запрос в БД по логину ($login)
    // Если пусто - записываем ошибку + редирект на логин

  // Проверка пароля   
  $userID = $db->query(
    "SELECT id FROM users WHERE login='$login' AND password= '$password' 
    ")->fetchAll(); 

    if (empty($userID)){
        $_SESSION['login-errors']['password'] = 'Wrong password';
        header ('Location: ../../login.php');
        exit;
    }
       // Применяет строку чистит её и возвращает чистую 
   $login = clearData ($login);
   $password = clearData ($password);

    $uniquerString = time();
    $token= "base64_encode" (
        "login=$login&password=$password&unique=$uniquerString"
    );
    // Записать в сессию в поле token
    $_SESSION ['token'] = $token;
   // Записать в БД в поле токен
   $db->query("
   UPDATE users SET token = '$token' 
   WHERE login = '$login' AND password = '$password'
   ")->fetchAll();
    header ('Location: ../../clients.php');
} else {
    echo json_encode ([
        "error" => 'Неверный запрос',
    ]);
}
?>
<?php
session_start();

// Вход по логину / паролю админа 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка наличия username и password
    $login = isset($_POST['username']) ? trim($_POST['username']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Проверка на пустые поля
    if (!$login || !$password) {
        $_SESSION['login-errors']['login'] = !$login ? 'Field is required' : '';
        $_SESSION['password-errors']['password'] = !$password ? 'Field is required' : '';
        header('Location: ../../login.php');
        exit;
    }

    // Функция для фильтрации данных
    function clearData($input) {
        return htmlspecialchars(strip_tags(trim($input)));
    }

    // Подключение к базе данных
    require_once '../db.php';

    // Проверка логина и получение пользователя
    $stmt = $db->prepare("SELECT id, password FROM users WHERE login = :login");
    $stmt->execute([':login' => $login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['login-errors']['login'] = 'User not found';
        header('Location: ../../login.php');
        exit;
    }

    // Проверка пароля
    if (!password_verify($password, $user['password'])) {
        $_SESSION['password-errors']['password'] = 'Wrong password';
        header('Location: ../../login.php');
        exit;
    }

    // Применяет строку чистит её и возвращает чистую 
    $login = clearData($login);
    
    // Генерация токена
    $uniquerString = time();
    $token = base64_encode("login=$login&unique=$uniquerString");

    // Записать в сессию в поле token
    $_SESSION['token'] = $token;

    // Записать в БД в поле токен
    $stmt = $db->prepare("UPDATE users SET token = :token WHERE id = :id");
    $stmt->execute([':token' => $token, ':id' => $user['id']]);

    header('Location: ../../clients.php');
} else {
    echo json_encode([
        "error" => 'Неверный запрос',
    ]);
}
?>

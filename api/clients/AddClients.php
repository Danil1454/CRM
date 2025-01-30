<?php session_start();
require_once '../DB.php';
if ($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;
    $fields = ['fullname', 'email', 'phone', 'birthday'];
    $errors = [];
    $_SESSION['clients_errors'] = '';
    // 1. Проверить пришли ли данные
    foreach ($fields as $key => $field){
        if (!isset($_POST[$field])){
            $errors[$field][] = 'Field is required';
        }
     }

    if (!empty($errors)) {
        $result = '<ul>';
        foreach ($errors as $key => $error) {
            $to_string = implode(',' , $error);
            $result = $result . "<li>$key : $to_string</li>";
        }
        $result = $result . '</ul>';
    
        $_SESSION['clients_errors'] = $result;
        header('Location: ../../clients.php');
        exit;
    }
   // 2. Фильтрация данных 
   // Функция для очистки данных
    function clearData($fields) {
       $fields = trim($fields);     
       $fields = stripslashes($fields); 
       $fields = strip_tags($fields);
       $fields = htmlspecialchars($fields);
    return $fields;
 }
    foreach ($formData as $key => $value) {
       $formData[$key] = clearData($value);
 }
    // 3. Проверить есть ли такой клиент 
    $phone = $formData['phone'];
    $IdClients = $DB->query(
        "SELECT id FROM clients WHERE phone = '$phone'
        ") ->fetchAll();
    
  
    // 4. Записать клиента
    if(empty($IdClients)){
        $created_at = date('Y-m-d H:i:s');
        $request = $DB->
        prepare("
        INSERT INTO `clients` (
        `name`,
        `email`,
        `phone`,
        `birthday`,
        `created_at`)
        VALUES (?,?,?,?,?)
        "
        )->execute([
            $formData['fullname'],
            $formData['email'],
            $formData['phone'],
            $formData['birthday'],
            $created_at
        ]);
        header("Location: ../../clients.php");

    }else{
        echo json_encode([
            "error" => 'Такой пользователь уже есть'
        ]);
    }

} else {
    echo json_encode([
        "error" => 'Неверный запрос'
    ]);
} 

?>
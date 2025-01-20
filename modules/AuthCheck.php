<?php
function AuthCheck($successPath ='', $errorPath ='' ) {
   
    require_once 'db.php';
    $_SESSION['token']='1234';

    // if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {

    //     // Если токен валиден, редиректим на успешный путь
    //     header("Location: $successPath");
    //     exit();
    // } else {
    //     // Если токен отсутствует или пустой, редиректим на путь ошибки
    //     header("Location: $errorPath");
    //     exit();
    // }

    if (!isset($_SESSION['token']) && $errorPath ($_SESSION['token'])) {
        // Если токен отсутствует или пустой, редиректим на путь ошибки
        header("Location: $errorPath");
        exit();
    }
    $token=$_SESSION['token'];
    $adminID = $db->query(
        "SELECT id FROM users WHERE token='$token'"
    )->fetchAll();
    
    // echo json_encode ($adminID);
    
    if (empty($adminID) && $errorPath){
        header("Location: $errorPath");
        exit();

    }
    if (!empty($adminID) && $successPath){
        header ("Location: $successPath");
        exit();
    }
    
}
?>

<?php


function AuthCheck($successPath ='', $errorPath ='' ) {
    require_once 'api/db.php';
    require_once 'LogoutUser.php';

    if (!isset($_SESSION['token'])){

        if ($errorPath){
            header("Location: $errorPath");
        }
    }

    $token=$_SESSION['token'];
    $adminID = $db->query(
        "SELECT id FROM users WHERE token='$token'
        ")->fetchAll();
    if (empty($adminID) && $errorPath){
        LogoutUser($errorPath, $db);
        
        header("Location: $errorPath");
  
    }
    if (!empty($adminID) && $successPath){
        header ("Location: $successPath");
    }   
}


?>

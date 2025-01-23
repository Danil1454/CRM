<?php 

function logoutUser($redirect, $db, $token = '') {
    unset($_SESSION['token']);
    
    if ($token) {
        $db->query("
        UPDATE users SET token = NULL
        WHERE token = '$token'
        ")->fetchAll();
    }
      header("Location: $redirect");
}



?>
<?php session_start();

// Проверить переменную $_SECCION
    // на наличие token , нет- редирект на
    // errorPath
    // http://localhost/CRM 
require_once 'api/auth/AuthCheck.php';

AuthCheck('clients.php');

// Сделать: 
// Вывод ошибки для пароля 
// Покрасить ошибку в красный цвет и поменьше 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>CRM | Авторизация</title>
    <link rel="stylesheet" href="styles/settings.css">
    <link rel="stylesheet" href="styles/pages/login.css">
</head>
<body>
    <div class="container">
        <h2>Авторизация</h2>
        <form action="api/auth/AuthUser.php" method="POST">
            <input type="text" name="username" placeholder="Логин" >
            <p class="error"> 
                <?php 
                if (isset($_SESSION['login-errors'])){
                    $errors = $_SESSION['login-errors'];
                    echo isset($errors['login']) ? $errors['login'] : '';
                }
                ?>
            </p>
            <input type="password" name="password" placeholder="Пароль" >
            <p class="error" > 
                <?php 
                if (isset($_SESSION['password-errors'])){
                    $errors = $_SESSION['password-errors'];
                    echo isset($errors['password']) ? $errors['password'] : '';
                }
                ?>
            </p>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>

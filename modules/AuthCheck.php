<?php

require_once 'DB.php';

// Проверить авторизацию (наличие токена, проверка токена)
// редирект на login/clients
function AuthCheck($successPath, $errorPath) {
    // Начинаем сессию, если она ещё не начата 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    // Проверяем наличие токена в сессии 
    if (isset($_SESSION['token']) && !empty($_SESSION['token'])) {
        // Если токен валиден, редиректим на успешный путь
        header("Location: $successPath");
        exit(); 
    } else {
        // Если токен отсутствует или пустой, редиректим на путь ошибки
        header("Location: $errorPath");
        exit();
    }
}

// Проверка токена текущего пользователя из БД
function getUserByToken($token) {
    // Создаем соединение с базой данных
    $db = new DB();
    
    // Подготовленный запрос для получения пользователя по токену
    $stmt = $db->prepare("SELECT * FROM users WHERE token = ?");
    $stmt->execute([$token]);
    
    // Получаем результат
    return $stmt->fetch();
}

// Начинаем сессию и получаем токен текущего пользователя
session_start();
$token = $_SESSION['token'] ?? null;

// Получаем пользователя по текущему токену
if ($token) {
    $admin = getUserByToken($token);
    
    if ($admin) {
        // Пользователь найден, можно продолжить работу с данными администратора
        // Например, можно сохранить данные в сессии или использовать их в приложении
        $_SESSION['admin'] = $admin;
    } else {
        // Токен недействителен, редиректим на страницу ошибки
        AuthCheck('login/clients', 'error_page.php');
    }
} else {
    // Токен отсутствует, редиректим на страницу ошибки
    AuthCheck('login/clients', 'error_page.php');
}
?>

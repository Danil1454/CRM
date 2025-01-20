<?php
session_start();

// Проверить переменную $_SECCION
    // на наличие token , нет- редирект на
    // errorPath
    // http://localhost/CRM
require_once 'modules/AuthCheck.php';

AuthCheck("clients.php","login.php");

?>
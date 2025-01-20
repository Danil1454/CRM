<?php 

$db = new PDO('musql:host=localhost;dbname=crm;charset=utf8',
'root',
null,
[
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

?>
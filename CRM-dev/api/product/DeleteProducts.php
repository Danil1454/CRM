<?php // Если ID существует и не пустой  

require_once '../DB.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = $_GET['id'];
    echo $id;


    $DB->query(
        "DELETE FROM products WHERE id = '$id'"
    )->fetchAll();
    header("Location: ../../product.php");
} else {
    header('Location: ../../product.php');
}

?>
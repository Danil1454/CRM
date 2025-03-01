<?php

function inputDefaultValue($field, $defaultValue ) {
    // Если $field  в параметрах  поиска существует
    if (isset($_GET[$field])) {
    // Если $field  в параметрах поиска пустой , берем значение
    // по умолчанию , иначе его
       $input = !empty($_GET[$field])? $_GET[$field] : $defaultValue;

   echo "value='$input'";
 } else {
    echo '';
}
}

?>
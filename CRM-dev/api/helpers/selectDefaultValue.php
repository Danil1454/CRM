<?php 

function selectDefaultValue($field, $options, $defaultValue){
      // $field - поле откуда брать занчение
      // $option - значение для селекта
      // $defaultValue - значение по умолчанию 

      foreach ($options as $key => $option){
        $key = $option['key'];
        $value = $option['value'];
        $selected = '';
        if (isset($_GET[$field]) && $_GET[$field] == $key) {
            $selected = 'selected';
        }
        if (!isset($_GET[$field]) && $key === $defaultValue) {
            $selected = 'selected';
        }
        echo "<option $selected value='$key'>$value</option>";
      }
}
?>
<?php 

function convertDateTime($dateTime){
    // Преобразуем строку даты в объект DateTime
    $date = new DateTime($dateTime);
    // Форматируем дату в нужный формат 
    return $date->format('H:i | d.m.Y');
}
function convertDate($dateTime){
    // Преобразуем строку даты в объект DateTime
    $date = new DateTime($dateTime);
    // Форматируем дату в нужный формат
    return $date->format('d.m.Y'); 
} 
?>
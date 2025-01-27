<?php 

function ClientsSearch($params, $DB){
    $clients = $DB->query(
        "SELECT * FROM clients
        ")->fetchAll();

        return $clients;
}

?>
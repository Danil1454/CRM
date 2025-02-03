<?php 

function ClientsSearch($params, $DB){
    $search = isset($params['search']) ? $params['search'] : '';
    $sort = isset($params['sort']) ? $params['sort'] : '';
    
    if ($sort){
        $sort = "ORDER BY name $sort";
    }
    $search = trim(strtolower($search));
        
    $clients = $DB->query("
            SELECT * FROM clients WHERE LOWER(name) LIKE '%$search%' $sort  
        ")->fetchAll();
   
    return $clients;
}

?>
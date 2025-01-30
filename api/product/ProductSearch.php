<?php 

function ProductSearch($params, $DB){
    $search = isset($params['search']) ? $params['search'] : '';
    // Добавить 
    $search_name = isset($params['search_name']) ? 
        $params['search_name'] : 'name';
    $sort = isset($params['sort']) ? $params['sort'] : '';
    
    $search = strtolower($search);

    $orderBy = '';
    if ($sort == '1') {
        $orderBy = " ORDER BY $search_name ASC";
    } elseif ($sort == '2'){
        $orderBy = " ORDER BY $search_name DESC";
    }
    
        
    $products = $DB->query("
            SELECT * FROM products WHERE LOWER(name) LIKE '%$search%' $orderBy 
        ")->fetchAll();
   
    return $products;
}

?>
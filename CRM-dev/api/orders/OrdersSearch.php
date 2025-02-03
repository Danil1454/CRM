<?php 

function OrdersSearch($params, $DB){
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
    
    
    $orders = $DB->query("
            SELECT
                orders.id,
                clients.name,
                orders.order_date,
                orders.total,
                GROUP_CONCAT(CONCAT(products.name,' ( ',order_items.quantity,'шт. : ',products.price,')') 
                SEPARATOR ', ') AS product_names
            FROM
                orders
            JOIN
                clients ON orders.client_id = clients.id
            JOIN
                order_items ON orders.id = order_items.order_id
            JOIN
                products ON order_items.product_id = products.id
            WHERE LOWER(clients.name) LIKE '%$search%'    
            GROUP BY
                orders.id, clients.name, orders.order_date, orders.total
           $orderBy  
       ")->fetchAll();
   
    return $orders;
}

?>

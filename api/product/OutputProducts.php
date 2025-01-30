<?php 
function OutputProducts($clients) {
    foreach ($clients as $key => $client) {
        $id = $client['id'];
        $name = $client['name'];
        $descrption = $client['description'];
        $price = $client['price'];
        $stock = $client['stock'];
        echo "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$descrption</td>
                <td>$price</td>
                <td>$stock</td>
                <td onclick=\"MicroModal.show('history-modal')\"><i class='fa fa-history'></i></td>
                <td onclick=\"MicroModal.show('edit-modal')\"><i class='fa fa-pencil'></i></td>
                <td><i class='fa fa-trash'></i></td>
            </tr>";
    }
}

?>
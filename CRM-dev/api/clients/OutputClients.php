<?php

function OutputClients($clients) {
    
    function convertParams($arr){
        $params = [];
        foreach ($arr as $key => $value){
            $params[] = "$key=$value";
        }
         return implode('&', $params); 
    }
  
    // Определите функцию для конвертации даты
    function convertDate($date) {
        return date('d.m.Y', strtotime($date));
    }
    
    // Определите функцию для конвертации даты и времени
    function convertDateTime($dateTime) {
        return date('d.m.Y H:i', strtotime($dateTime));
    }
  
    foreach ($clients as $key => $client) {
        $id = $client['id'];
        $name = $client['name'];
        $email = $client['email'];
        $phone = $client['phone'];
        $birthday = $client['birthday'];
        $created_at = $client['created_at'];
        
        // Используйте определенные функции для конвертации даты и даты/времени
        $birthday = convertDate($birthday);
        $created_at = convertDateTime($created_at);

        $copyParams = $_GET;
        $copyParams['send-email'] = $email;
        $queryParams = convertParams($copyParams);

        echo "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td><a href='?$queryParams'>$email</a></td>
                <td>$phone</td>
                <td>$birthday</td>
                <td>$created_at</td>
                <td>
                   <form method='GET' action='api/clients/ClientHistory.php'>
                      <input value='$id' name='id' hidden>
                      <input type='date' id='form' name='from'>
                      <input type='date' id='to' name='to'> <!-- Исправлена ошибка в имени атрибута -->
                      <button
                         style='display: block;'
                         type='submit'
                        >Сформировать</button> 
                   </form> 
                </td>
                
                <td onclick=\"MicroModal.show('edit-modal')\"><i class='fa fa-pencil'></i></td>
                <td><a href='api/clients/ClientsDelete.php?id=$id'><i class='fa fa-trash'></i></a></td>
            </tr>";
    }
}

?>

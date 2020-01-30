<?php
require_once 'connect.php';
connection();
$query =
"SELECT 
C.firstName,C.lastName,CA.city,
Hob.value hobbies, GETIN.value getintouch 
from customers C
LEFT JOIN customer_address CA ON c.customer_id = ca.customer_id
LEFT JOIN customer_additional_info Hob ON c.customer_id = hob.customer_id 
AND hob.field_key = 'hobbies'
LEFT JOIN customer_additional_info GETIN  ON c.customer_id = getin.customer_id 
AND getin.field_key = 'getintouch'";
if ($query_run = mysqli_query($conn, $query)) {
    while ($row = mysqli_fetch_assoc($query_run)) {
        foreach ($row as $key => $value) {
            echo $value . '<br>';
        }
    }
}

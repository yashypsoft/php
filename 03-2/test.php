<?php
require_once 'config.php';

$conn = connection();
$query = "SELECT
        c.title parentCategory,
        GROUP_CONCAT(d.title) childCategory
        FROM
        category c
        left JOIN category d ON
        c.id = d.parent_category_id
        GROUP BY c.title OR d.parent_category_id = 0";
if($result = mysqli_query($conn,$query)){
    while($row = mysqli_fetch_assoc($result)){
        print_r($row);  
    }
}

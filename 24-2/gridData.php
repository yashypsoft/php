<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
</head>

<body>

<?php require_once 'Adapter.php'; 
    $query = "SELECT id,title,content from `posts`";
    $adapter = new Adapter();
    $result = $adapter->fetchAll($query);
?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Content</th>
        <th>Action</th>
    </tr>
    <tr>
        <?php foreach($result as $key => $row): ?>
               <?php
                 $table = "";
                 $table .= "<tr>";
                 foreach ($row as $key => $value) {
                     $table .= "<td>$value</td>";
                 }
                 $table.= "<td><a href='./?id=$row[id]'>edit</a></td>";
                 $table.= "<td>
                        <a href='http://localhost/cybercom/php/24-2/deletePost.php/?id=$row[id]'>
                        Delete</a>
                        </td>";
                 $table .= "</tr>";
                 echo $table;
                ?>
        <?php endforeach; ?>
    </tr>

</table>


</body>

</html>
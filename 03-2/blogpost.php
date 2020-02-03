<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Post</title>
</head>

<body>
    <?php require_once 'postData.php';
    require_once 'config.php';
     $data = displayBlogPost(); 
    $row = mysqli_fetch_assoc($data);
    $table = "<tr>";
    foreach ($row as $value) {
        $table .= "<td>$value<td>";
        $id = $row['id'];
    
   
    }
    $table.= "<td><a href='?addpost/id=$id'>Edit</a></td>";
    $table.= "<td><a href='?id=$id'>delete</a></td>";
    $table.="</tr>";

    ?>

    <div class="container">
        <div class="nav">
            <a href="blogCategory.php">Manage Blog Post</a>
            <a href="#">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
        <div>
            <a href="addcategory.php">Add Category</a>
        </div>
        <table>
            <?php echo $table ?>


        </table>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog Category</title>
</head>

<body>
    <?php require_once 'postData.php';
    require_once 'config.php';
    $dataGrid = listblogCategory($_SESSION['id']);
    if (isset($_GET['id'])) {
        deleteCategory($_GET['id']);
    }
    ?>
    <?php isset($_SESSION['id']) ? " " : header("Location: login.php"); ?>
    <div class="container">
        <div class="nav">
            <a href="blogpost.php">Manage Blog Post</a>
            <a href="#">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
        <div>
            <a href="addcategory.php">Add Category</a>
        </div>
    </div>
</body>

</html>
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
    $dataGrid = listBlogPost($_SESSION['id']);
    if (isset($_GET['id'])) {
        deletePost($_GET['id']);
    } 
    ?>
    <?php isset($_SESSION['id']) ? " " : header("Location: login.php"); ?>

    <div class="container">
        <div class="nav">
            <a href="blogCategory.php">Manage Blog Post</a>
            <a href="#">My Profile</a>
            <a href="logout.php">Logout</a>
        </div>
        <div>
            <a href="addpost.php">Add Post</a>
        </div>
        <table border="1px">
            <?= (displayColumn($dataGrid)) ?>
            <?= (displayData($dataGrid)) ?>
        </table>
    </div>

</body>

</html>
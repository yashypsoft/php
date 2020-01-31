<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Display</title>
</head>

<body>
    <div>
        <?php
        require_once 'connect.php';
        connection();
        $dataGrid = displayDatainGrid();
        if (isset($_GET['id'])) {
            deleteData($_GET['id']);
        } 
        ?>
    </div>
    <div>
        <a href="index.php">Register Data</a>

        <table border="1px">
            <tr>
            
            </tr>
            <tr>
                <?= ($dataGrid) ?>
            </tr>
        </table>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <?php
        require_once 'connect.php';
        connection();
        setData('customer',['id','name','gender','address','phone']);
        fetchAll('*', 'customer');
        ?>
    </div>

    <form action="index.php" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name">
        </div>
        <div>
            <label for="gender">Gender</label>
            <input type="text" name="gender">
        </div>
        <div>
            <label for="add">address</label>
            <input type="text" name="address">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="number" name="phone">
        </div>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>
<?php
    if(isset($_GET['email'])){
        $email = htmlentities($_GET['email']);
        if(!empty($email)){
            echo $email;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form</title>
</head>

<body>
    <form action="formGet.php" method="get">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
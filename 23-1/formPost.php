<?php
if (isset($_POST['email'])) {
    $email = htmlentities($_POST['email']);
    if (!empty($email)) {
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
    <form action="formPost.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        <input type="submit" value="Submit">
    </form>
</body>

</html>
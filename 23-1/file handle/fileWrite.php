<?php

if (isset($_POST['name'])) {
    $name = htmlentities($_POST['name']);
    if (!empty($name)) {
        $handle = fopen("names.txt", "a");
        fwrite($handle, $name);

        $ff = file('names.txt');
        print_r($ff);
    } else {
        echo "please enter in name field";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NameForm</title>
</head>

<body>
    <form action="fileWrite.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <input type="submit" value="submit">
    </form>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home</title>
</head>

<body>
    <?php
    $name='yash';
    $age =20;
    ?>
    <h1>Hello <?php echo $name ?></h1>
    <div>
        <label for="age">Age</label>
        <input type="text" name="age" id="age" value="<?php echo $age ?>">
    </div>



</body>

</html>
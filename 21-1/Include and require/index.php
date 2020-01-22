<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index Page</title>
</head>

<body>

    <!-- include and require    -->
    <!-- It is recommended to use the require() statement if you're including the library files or files containing the functions and configuration variables that are essential for running your application, such as database configuration file. -->
    <?php
    require_once('header.php');
    require('header.php');
    require_once('header.php');

    ?>

    <?php
    echo '<br>';
    echo "Hello $name";
    echo '<br>';

    ?>

    <?php
    include_once('footer.php');
    include('footer.php');
    include_once('footer.php');


    ?>


</body>

</html>
<?php

$name = $_FILES['file']['name'];
// echo "<br>";
// echo $_FILES['file']['size'];

$extension = substr($name, strpos($name, '.') + 1);
$type = @$_FILES['file']['type'];
// echo "<br>";

$temp = @$_FILES['file']['tmp_name'];

if (isset($name)) {
    if (!empty($name)) {
        if ($extension == 'jpg' || $extension == "jpeg" && $type == "image/jpeg") {
            $location = 'upload/';
            if (move_uploaded_file($temp, $location . $name)) {
                echo "uploaded ";
            } else {
                echo "Error in upload";
            }
        } else {
            echo "please upload only  jpeg file";
        }
    } else {
        echo "please choose a file";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>

<body>
    <form action="fileupload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file"><br>
        <input type="submit" value="Submit">

    </form>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form</title>
</head>

<body>
    <?php
    require_once 'request.php';
    echo "<pre>";
    $req = new Request();

    $result = $req->getPost(NULL, 'll');

    var_dump($result);
    print_r($req);
    ?>
    <form action="form.php" method="POST">
        <input type="text" name="name">
        <input type="submit" value="submit">
    </form>
</body>

</html>
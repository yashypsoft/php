<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BLog</title>
</head>

<body>
    <?php
    require_once 'config.php';
    if (isset($_GET['postid'])) {
        $data = getEditData('blog_post', $_GET['postid']);
    }
    ?>
    <div>
        <h2>Title :<?= $data['title']  ?> </h2>
    </div>
    <div>
        <p>date : <?= $data['published_at'] ?></p>
    </div>
    <div>
        <p>Content : <?= $data['content'] ?></p>
    </div>
    <div>
        <p>url :
            <a href="<?= $data['url'] ?>"><?= $data['url'] ?></a>
        </p>
    </div>
    <div>
        <p>Category : <?= $data['category'] ?></p>
    </div>
</body>

</html>
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
    require_once 'postData.php';
    require_once 'config.php';
    $c = "";
    $data = (isset($_GET['postid'])) ? getEditData('blog_post', $_GET['postid']):"" ;
    $tempCategory =fetch('post_category',['post_id' => $data['id'] ]);
    for($i=0;$i<sizeof($tempCategory);$i++){
        $id = $tempCategory[$i]['category_id'];
        $category = (isset($data['id'])) ? getEditData('category', $id):"" ;
        $c .= $category['title'] . ','  ;
    }
    $c = rtrim($c,',');
    
    
    ?>
     <?php isset($_SESSION['id']) ? " " : header("Location: login.php"); ?>
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
        <p>Category : <?= $c ?></p>
    </div>
</body>

</html>
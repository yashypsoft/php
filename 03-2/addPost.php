<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">

    <title>ADD New Category</title>
</head>

<body>
    <?php require_once 'postData.php';
    require_once 'config.php';
    $temp = fetch('category', ['parent_category_id' => '0']);
    $category = [];
    for ($i = 0; $i < sizeof($temp); $i++) {
        array_push($category, $temp[$i]['title']);
    }
    if (isset($_GET['id'])) {
        $data = getEditData('blog_post', $_GET['id']);
    }
    ?>
    <?php isset($_SESSION['id']) ? " " : header("Location: login.php"); ?>

    <div>
        <form action="" method="Post">
            <div>
                <label for="title">Title</label>
                <input type="text" name="post[title]" id="title" 
                value="<?= getData('post', 'title') ?>">
                <?php if (ValidateData('post', 'title')) : ?>
                    <span>Enter valid title<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="post[content]" id="content" cols="30"
                 rows="10"><?= getData('post', 'content') ?></textarea>
                <?php if (ValidateData('post', 'content')) : ?>
                    <span>Enter valid content<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="url">URL</label>
                <input type="url" name="post[url]" id="url"
                 value="<?= getData('post', 'url') ?>">
                <?php if (ValidateData('post', 'url')) : ?>
                    <span>Enter valid url<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="publishedAt">Published at</label>
                <input type="datetime-local" name="post[published_at]"
                 id="publishedAt" value="<?= getData('post', 'published_at') ?>">
                <?php if (ValidateData('post', 'published_at')) : ?>
                    <span>Enter valid Date<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="categoty">Category :</label>
                <select name="post[category][]" multiple>

                    <?php foreach ($category as $item) : ?>
                        <?php
                        $selected = (in_array($item, getData('post', 'category', [])))
                            ? "selected='selected'"
                            : ""
                        ?>
                        <option value="<?= $item; ?>" <?= $selected ?>><?= $item; ?> </option>
                    <?php endforeach; ?>
                </select>
                <?php if (ValidateData('post', 'category')) : ?>
                    <span>Please select one<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="image">Profile Image :</label>
                <input type="file" name="posts[image]" id="image">
            </div>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>

    <?php

    $id = isset($_GET['id']) ? $_GET['id'] : "0";
    if ($validFlag == 0 && isset($_POST['submit'])) {
        if (($id)) {
            $blog = prepareData($_POST['post']);
            $blog['image'] = $_POST['posts']['image'];
            $blog['updated_at'] = Date("Y:m:d h:i:s");
            $blog['user_id'] = $_SESSION['id'];
            updateData('blog_post', $blog, $id);
            header("Location: ../blogpost.php");
        } else {
            $blog = prepareData($_POST['post']);
            $blog['image'] = $_POST['posts']['image'];
            $blog['created_at'] = Date("Y:m:d h:i:s");
            $blog['user_id'] = $_SESSION['id'];
            insertData('blog_post', $blog);
            header("Location: blogpost.php");
        }
    }

    ?>
</body>

</html>
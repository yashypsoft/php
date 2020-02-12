<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>ADD New blogpost</title>
</head>

<body>
    <?php require_once 'addpost_Operation.php' ?>
    <div>
        <form action="" method="Post" enctype="multipart/form-data">
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
                <select name="post_cat[category][]" multiple id="categoty"> 

                    <?php foreach ($category as $key => $item) : ?>
                        <?php
                        $selected = (in_array($key, getData('post_cat', 'category', [])))
                            ? "selected='selected'"
                            : ""
                        ?>
                        <option value="<?= $key; ?>" <?= $selected ?>><?= $item; ?> </option>
                    <?php endforeach; ?>
                </select>
                <?php if (ValidateData('post_cat', 'category')) : ?>
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
    <?php addupdatePost($validFlag) ?>
</body>

</html>
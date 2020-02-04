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
    $category = ['Parent Category'];
    for ($i = 0; $i < sizeof($temp); $i++) {
        array_push($category, $temp[$i]['title']);
    }
    if (isset($_GET['id'])) {
        $data = getEditData('category', $_GET['id']);
    }
    ?>
    <?php isset($_SESSION['id']) ? " " : header("Location: login.php"); ?>
    <div>
        <form action="" method="Post">
            <div>
                <label for="title">Title</label>
                <input type="text" name="category[title]" id="title" 
                value="<?= getData('category', 'title') ?>">
                <?php if (ValidateData('category', 'title')) : ?>
                    <span>Enter valid title <span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="category[content]" id="content" cols="30"
                 rows="10"><?= getData('category', 'content') ?></textarea>
                <?php if (ValidateData('category', 'content')) : ?>
                    <span>Enter valid content<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="url">URL</label>
                <input type="url" name="category[url]" id="url" 
                value="<?= getData('category', 'url') ?>">
                <?php if (ValidateData('category', 'url')) : ?>
                    <span>Enter valid url<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="metatitle">Meta Title</label>
                <input type="text" name="category[meta_title]" id="metatitle"
                 value="<?= getData('category', 'meta_title') ?>">
                <?php if (ValidateData('category', 'meta_title')) : ?>
                    <span>Enter valid meta_title<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="prefix">Parent Category</label>
                <select name="category[parent_category_id]" id="prefix">

                    <?php foreach ($category as $id => $item) : ?>
                        <option value="<?= $id ?>">
                            <?php echo $item ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="profileImage">Profile Image :</label>
                <input type="file" name="categorys[image]" id="profileImage">

            </div>
            <input type="submit" value="Submit" name="submit">
        </form>
        <?php
        $id = isset($_GET['id']) ? $_GET['id'] : "0";

        if ($validFlag == 0 && isset($_POST['submit'])) {
            if (($id)) {
                $category = prepareData($_POST['category']);
                $category['updated_at'] = Date("Y:m:d h:i:s");
                updateData('category', $category, $id);
                header("Location: ../blogCategory.php");
            } else {
                $category = prepareData($_POST['category']);
                $category['created_at'] = Date("Y:m:d h:i:s");
                insertData('category', $category);
                header("Location: blogCategory.php");
            }
        }
        ?>
    </div>
</body>

</html>
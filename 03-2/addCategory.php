<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD New Category</title>
</head>

<body>
    <?php require_once 'postData.php';
    require_once 'config.php';
    $query_run = fetchRow('parent_category');
    while ($row = mysqli_fetch_assoc($query_run)) {
        $parentCategoty = explode(',', $row['parent_category']);
    }
    ?>
    <div>
        <form action="" method="Post">
            <div>
                <label for="title">Title</label>
                <input type="text" name="category[title]" id="title">
                <?php if (ValidateData('category', 'title')) : ?>
                    <span>Enter valid title <span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea name="category[content]" id="content" cols="30" rows="10"></textarea>
                <?php if (ValidateData('category', 'content')) : ?>
                    <span>Enter valid content<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="url">URL</label>
                <input type="url" name="category[url]" id="url">
                <?php if (ValidateData('category', 'url')) : ?>
                    <span>Enter valid url<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="metatitle">Title</label>
                <input type="text" name="category[meta_title]" id="metatitle">
                <?php if (ValidateData('category', 'meta_title')) : ?>
                    <span>Enter valid meta_title<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="prefix">Parent Category</label>
                <select name="category[parent_category_id]" id="prefix">

                    <?php foreach ($parentCategoty as $id => $category) : ?>
                        <option value="<?= $id ?>">
                            <?php echo $category ?>
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
        
        if ($validFlag == 0 && isset($_POST['submit'])) {
            $category = prepareData($_POST['category']); 
            $catogory['created_at'] = Date("Y:m:d h:i:s");
            insertData('category', $category);
        }
        ?>
    </div>
</body>

</html>
<?php $title = "AddPost";
    require_once 'Adapter.php';
    require_once 'editPost.php';
    require_once 'header.php';
?>
    <form action="<?=$action?>" method="POST">
        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="<?=getData('title'); ?>">
            <input type="hidden" name="id" value="<?= ($data['id']) ?>">
        </div>
        <div>
            <label for="content">Content</label>
            <input type="text" name="content" id="content" value="<?= getData('content'); ?>">
        </div>
        <input type="submit" value="submit">
    </form>
   
</body>

</html>
<?php
require_once 'postData.php';
require_once 'config.php';
require_once 'fileUpload.php';
$temp = fetch('category', ['parent_category_id' => '0']);
$category = [];
for ($i = 0; $i < sizeof($temp); $i++) {
    $category[$temp[$i]['id']] = $temp[$i]['title'];
}
isset($_SESSION['id']) ? " " : header("Location: login.php");
$data = isset($_GET['id']) ? getEditData('blog_post', $_GET['id']) : "";

function addupdatePost($validFlag)
{
    $id = isset($_GET['id']) ? $_GET['id'] : "0";
    if ($validFlag == 0 && isset($_POST['submit'])) {
        if (($id)) {
            $blog = prepareData($_POST['post']);
            $blog['image'] = $_FILES['posts']['name']['image'];
            $blog['updated_at'] = Date("Y-m-d h:i:s");

            $blog['user_id'] = $_SESSION['id'];
            updateData('blog_post', $blog, $id);
            header("Location: ../blogpost.php");
        } else {
            $blog = prepareData($_POST['post']);
            $blog['image'] = $_FILES['posts']['name']['image'];
            $blog['created_at'] = Date("d-m-Y h:i:s");
            $blog['user_id'] = $_SESSION['id'];
            fileUpload('posts', 'image', 'blog');
            $postCat['post_id']  = insertData('blog_post', $blog);
            foreach ($category_id = prepareData($_POST['post_cat']['category']) as $postCat['category_id']) {
                insertData('post_category', $postCat);
            };
            header("Location: blogpost.php");
        }
    }
}

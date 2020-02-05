<?php
require_once 'postData.php';
require_once 'config.php';
require_once 'fileUpload.php';
$temp = fetch('category', ['parent_category_id' => '0']);
$category = ['Parent Category'];
for ($i = 0; $i < sizeof($temp); $i++) {
    $category[$temp[$i]['id']] = $temp[$i]['title'];
}
print_r($category);
if (isset($_GET['id'])) {
    $data = getEditData('category', $_GET['id']);
}
isset($_SESSION['id']) ? " " : header("Location: login.php");

function addupdateCategory($validFlag)
{
    $id = isset($_GET['id']) ? $_GET['id'] : "0";

    if ($validFlag == 0 && isset($_POST['submit'])) {
        if (($id)) {
            $category = prepareData($_POST['category']);
            $category['updated_at'] = Date("Y-m-d h:i:s");
            $category['image'] = $_FILES['categorys']['name']['image'];
            updateData('category', $category, $id);
            header("Location: ../blogCategory.php");
        } else {
            $category = prepareData($_POST['category']);
            $category['created_at'] = Date("Y-m-d h:i:s");
            $category['image'] = $_FILES['categorys']['name']['image'];
            fileUpload('categorys', 'image', 'Category');
            insertData('category', $category);
            header("Location: blogCategory.php");
        }
    }
}

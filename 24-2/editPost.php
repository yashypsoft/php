<?php
require_once "Adapter.php";

$action = "addPost.php";

function getData($field)
{
    global $data;
    if(isset($data[$field]) && !empty($data[$field])){
        return $data[$field];
    }
    else{
        return "";
    }
}
       
if(isset($_GET['id'])){
    $action = "editPost.php";
    $adpater = new Adapter();
    $id = $_GET['id'];
    $query = "SELECT id,title,content FROM posts WHERE id = $id";
    $data = $adpater->fetchRow($query);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $adapter = new Adapter();
    extract($_POST);
    $query = "UPDATE `posts` SET `title`= '$title' , `content` = '$content'  WHERE id = $id"; 
    if($adapter->update($query)){
        header("Location:gridData.php");
    }else{
        throw new Exception("Error in Update");   
    }

}
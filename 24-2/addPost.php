<?php

require_once 'Adapter.php';

$adapter = new Adapter();
extract($_POST);
$query = "INSERT INTO `posts` (`title`,`content`) VALUES 
        ('$title','$content')";
if ($adapter->insert($query)) {
    header("Location:gridData.php");
} else {
    throw new Exception("Error in Insert");
}

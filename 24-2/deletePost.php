<?php
require_once 'Adapter.php';
$adapter = new Adapter();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM `posts` WHERE id = $id ";
    if (!$adapter->delete($query)) {
        throw new Exception("Error in Delete");
    }
    header("Location:../gridData.php");
}

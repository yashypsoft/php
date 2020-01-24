<?php
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    header("Location: ./thank.php");
}

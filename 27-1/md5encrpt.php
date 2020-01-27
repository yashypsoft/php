<?php

if (isset($_POST['pass']) && !empty($_POST['pass'])) {
    $inputPass = md5($_POST['pass']);

    $fileName = 'hash.txt';
    $handle = fopen($fileName, 'r');
    $filePass = fread($handle, filesize($fileName));

    if ($filePass == $inputPass) {
        echo "Password Match";
    } else {
        echo "Password Incorrect";
    }
}
?>


<form action="md5encrpt.php" method="post">
    <div>Password</div>
    <input type="password" name="pass" id="pass">
    <input type="submit" value="Submit">
</form>
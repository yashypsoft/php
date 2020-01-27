<?php
if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $to = $_POST['email'];
        $body = $_POST['message'];
        $header = $_POST['name'];
        $subject  = "test mail";

        if (mail($to, $subject, $body, $header)) {
            echo "message send to $to successfully";
        } else {
            echo "mail sending failed";
        }
    } else {
        echo "enter in field";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>

<body>
    <form action="mailForm.php" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <br>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <br>
        <div>
            <label for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10"></textarea>
        </div>
        <br>

        <input type="submit" name="submit" value="Send">

    </form>

</body>

</html>
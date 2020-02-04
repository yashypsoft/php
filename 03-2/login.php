<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Register - Blog Application</title>
</head>

<body>
    <?php require_once 'postData.php';
    require_once 'config.php';
    ?>
    <div>
        <form action="" method="POST">
            <h2>Login</h2>


            <div>
                <label for="email">Email</label>
                <input type="email" name="user[email]" id="email">
                <?php if (ValidateData('user', 'email')) : ?>
                    <span>Enter valid Email<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" name="user[password]" id="password">
                <?php if (ValidateData('user', 'password')) : ?>
                    <span>Enter valid password <span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>


            <input type="submit" value="Login" name="submit">
            <a href="register.php">Register</a>
        </form>
    </div>

    <div>
        <?php

        if ($validFlag == 0 && isset($_POST['submit'])) {
            $id =   validateEmailPass($_POST['user']['email'], md5($_POST['user']['password']));
            if (isset($id)) {
                $_SESSION['id'] = $id;
                header("Location: blogPost.php");
            } else {
                echo "Enter valid email and password";
            }
        }
        ?>
    </div>
</body>

</html>
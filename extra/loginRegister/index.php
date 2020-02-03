<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit-icons.min.js"></script>
    <title>Login</title>
</head>

<body>
    <div class="uk-container  uk-container-xsmall">
        <div>
            <?php
            require_once 'loginFeature.php';
            require_once 'config.php';
            $p1 = new Person();
            ?>
        </div>
        <h2>Login</h2>
        <form action="" method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" class="uk-input" name="user[email]" id="email">

            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" class="uk-input uk-margin-small-bottom" name="user[password]" id="password">
                <?php if ($p1->validate('password')) : ?>
                    <span>Enter valid password</span>
                <?php $isValid++;
                endif; ?>
            </div>
            <input type="submit" name="submit" value="Login" class="uk-button uk-button-primary">
        </form>
        <h3><a href="register.php" class="uk-button uk-button-secondary">Register Here</a></h3>
        <?php

        if ($isValid == 0 && isset($_POST['submit'])) {
            $user = $_POST['user'];
            echo $id = ($user_id = fetchRow('users', $user))['id'];
            $_SESSION['id'] = $id;
            $_SESSION['loginflag'] = "hello";
            $_SESSION['lfi'] = Date("Y:m:d h:i:s");
            if (isset($id)) {
                header("Location: home.php");
            } else {
                echo "<script>
                UIkit.notification({
                    message: 'Enter valid Email and Password ',
                    pos: 'top-center'
                });
                </script>";
            }
        }
        ?>
    </div>
</body>

</html>
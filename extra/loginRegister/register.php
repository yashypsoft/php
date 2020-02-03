<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/css/uikit.min.css" />

    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.3.0/dist/js/uikit-icons.min.js"></script>
    <title>Register</title>
</head>

<body>
    <div class="uk-container uk-container-xsmall">
        <div>
            <?php
            require_once 'loginFeature.php';
            require_once 'config.php';
            $p1 = new Person();
            ?>
        </div>
        <h2>Register</h2>
        <form action="" method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" class="uk-input" name="user[email]" id="email">
                <?php if ($p1->validate('email')) : ?>
                    <script>
                        UIkit.notification({
                            message: 'Enter valid email OR Email already exist',
                            pos: 'top-center'
                        });
                    </script>
                <?php $isValid++;
                endif; ?>
            </div>
            <div class="uk-animation-toggle" tabindex="0">
                <div class="uk-animation-shake">
                    <label for="password">Password</label>
                    <input type="password" class="uk-input uk-margin-small-bottom" name="user[password]" id="password">
                    <?php if ($p1->validate('password')) : ?>
                        <span>Enter valid Password</span>
                    <?php $isValid++;
                    endif; ?>
                </div>
            </div>
            <input type="submit" name="submit" class="uk-button uk-button-primary" value="Register">
        </form>
        <h3><a href="index.php" class="uk-button uk-button-secondary">Login Here</a></h3>

        <?php
        if ($isValid == 0 && isset($_POST['submit'])) {
            $user = userData($_POST['user']);
            insertData('users', $user);
            header("Location: index.php");
        }
        ?>
    </div>
</body>

</html>
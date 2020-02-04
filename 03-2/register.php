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
    if (isset($_GET['id'])) {
        $data = getEditData('user',$_GET['id']);
    }
    ?>
    <div>
        <form action="" method="POST">
            <h2>Register</h2>
            <div>
                <label for="prefix">Prefix</label>
                <select name="user[prefix]" id="prefix">
                    <?php $prefixData = ['Prefix', 'Mr', 'Miss', 'Mrs', 'Dr']; ?>
                    <?php foreach ($prefixData as $prefix) : ?>
                        <?php
                        $selected = (getData('user', 'prefix') == $prefix)
                            ? "selected"
                            : ""
                        ?>
                        <option value="<?= $prefix ?>" <?= $selected ?>>
                            <?php echo $prefix ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (ValidateData('user', 'prefix')) : ?>
                    <span>Enter valid Prfix<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="firstName">First Name</label>
                <input type="text" name="user[first_name]" value="<?= getData('user', 'first_name') ?>">
                <?php if (ValidateData('user', 'first_name')) : ?>
                    <span>Enter valid First Name<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="lastName">Last Name</label>
                <input type="text" name="user[last_name]" value="<?= getData('user', 'last_name') ?>">
                <?php if (ValidateData('user', 'last_name')) : ?>
                    <span>Enter valid Last Name<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="user[email]" id="email" value="<?= getData('user', 'email') ?>">
                <?php if (ValidateData('user', 'email')) : ?>
                    <span>Enter valid Email<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="phoneNo">Phone No : </label>
                <input type="number" name="user[mobile]" id="phoneNo" value="<?= getData('user', 'mobile') ?>">
                <?php if (ValidateData('user', 'mobile')) : ?>
                    <span>Enter Mobile Number<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="user[password]" id="password" value="<?= getData('user', 'password') ?>">
                <?php if (ValidateData('user', 'password')) : ?>
                    <span>Enter valid password <span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="temp[confirm_password]" id="password">
                <?php if (ValidateData('temp', 'confirm_password')) : ?>
                    <span>password and confirm password does not amtch <span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <label for="information">Information</label>
                <textarea name="user[information]" id="information" cols="30" rows="10"><?= getData('user', 'information') ?></textarea>
                <?php if (ValidateData('user', 'information')) : ?>
                    <span>Enter Information<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>
            <div>
                <input type="checkbox" name="temp[tnc]" id="ync">
                <p>Hereby, I Accept Term and conditions.</p>
                <?php if (ValidateData('temp', 'tnc')) : ?>
                    <span>Please check t&c<span>
                        <?php $validFlag++;
                    endif;  ?>
            </div>

            <input type="submit" value="Register" name="submit">
        </form>
    </div>

    <div>
        <?php
        $uid = isset($_GET['id']) ? $_GET['id'] : "0";
        if ($validFlag == 0 && isset($_POST['submit'])) {
            if ($uid) {
                $user = prepareData($_POST['user']);
                $user['password'] = md5($_POST['user']['password']);
                $user['updated_at'] = Date("Y:m:d h:i:s");
                updateData('user', $user, $uid);
                $_SESSION['id'] = $uid;
                header("Location: blogPost.php");
            } else {
                if (checkEmail($_POST['user']['email'])) {
                    $user = prepareData($_POST['user']);
                    $user['password'] = md5($_POST['user']['password']);
                    $user['created_at'] = Date("Y:m:d h:i:s");
                    $id = insertData('user', $user);
                    $_SESSION['id'] = $id;
                    header("Location: blogPost.php");
                } else {
                    echo "Email Already Registered";
                }
            }
        }

        ?>
    </div>
</body>

</html>
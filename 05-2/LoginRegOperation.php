<?php
require_once 'postData.php';
require_once 'config.php';
if (isset($_GET['id']) && $_SESSION['id']) {
    $data = getEditData('user', $_GET['id']);
}

function LoginOp($validFlag)
{
    if ($validFlag == 0 && isset($_POST['submit'])) {
        $id =   validateEmailPass($_POST['user']['email'], md5($_POST['user']['password']));
        if (isset($id)) {
            $_SESSION['id'] = $id;

            header("Location: blogPost.php");
        } else {
            echo "Enter valid email and password";
        }
    }
}


function regOperation($validFlag){
    $uid = isset($_GET['id']) ? $_GET['id'] : "0";
    if ($validFlag == 0 && isset($_POST['submit'])) {
        if ($uid) {
            $user = prepareData($_POST['user']);
            $user['password'] = md5($_POST['user']['password']);
            $user['updated_at'] = Date("Y-m-d h:i:s");
            updateData('user', $user, $uid);
            $_SESSION['id'] = $uid;
            header("Location: blogPost.php");
        } else {
            if (checkEmail($_POST['user']['email'])) {
                $user = prepareData($_POST['user']);
                $user['password'] = md5($_POST['user']['password']);
                $user['created_at'] = Date("Y-m-d h:i:s");
                $id = insertData('user', $user);
                $_SESSION['id'] = $id;
                header("Location: blogPost.php");
            } else {
                echo "Email Already Registered";
            }
        }
    }
}

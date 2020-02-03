<?php
$isLogged = false;
session_start();
$isValid = 0;
require 'config.php';
class Person
{
    function validate($fieldData)
    {
        connection();
        if (isset($_POST['submit'])) {
            $value =  $_POST['user'][$fieldData];
            switch ($fieldData) {
                case 'email':
                    if (
                        preg_match(
                            '/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/',
                            $value
                        )
                        &&
                        checkData($value)
                    ) {
                        return false;
                    } else {
                        return true;
                    }
                    break;
                case 'password':
                    if (!empty($value)) {
                        return false;
                    } else {
                        return true;
                    }
                    break;
            }
        }
    }
}

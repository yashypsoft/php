<?php
session_start();
require_once 'connect.php';
$validFlag = 0;

function getData($category, $fieldData, $returnType = "")
{
    return (isset($_POST[$category][$fieldData]) ?  $_POST[$category][$fieldData]
        :  getSessionData($category, $fieldData, $returnType));
}

function setSessionData($category)
{
    $_SESSION[$category] = (isset($_POST[$category]) ? $_POST[$category]  : []);
}

function getSessionData($category, $fieldData, $returnType = "")
{
    return isset($_SESSION[$category][$fieldData]) ? ($_SESSION[$category][$fieldData]) : $returnType;
}



function ValidateData($section, $fieldname)
{

    if (isset($_POST['submit'])) {
        $value = getData($section, $fieldname);
        switch ($fieldname) {
            case 'prefix':
                return ($value != 'Prefix') ? false : true;
                break;
            case 'phoneNo':
                return (strlen($value) == 10) ? false : true;
                break;
            case 'email':
                return
                    preg_match('/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/', $value)
                    ? false
                    : true;
                break;
            case 'firstName':
            case 'lastName':
                return  preg_match('/^[a-zA-Z]{1,10}$/', $value)
                    ? false
                    : true;
                break;
            case 'dob':
            case 'address1':
            case 'address2':
            case 'company':
            case 'city':
            case 'password':
            case 'confirmPassword':
            case 'describeYourself':
            case 'state':
                return !empty($value) ? false : true;
                break;
            case 'contry':
                return ($value != 'Contry') ? false : true;
                break;
            case 'postalCode':
                return (strlen($value) == 6) ? false : true;
                break;
            case 'numberClient':
                return ($value != 'Client-Week') ? false : true;
                break;
            case 'getintouch':
            case 'hobbies':
            case 'businessYear':
                return (isset($_POST[$section][$fieldname])) ? false : true;
                break;
            case 'profileImage':
            case 'certificate':
                return (!empty($_FILES[$section]['name'][$fieldname])) ? false : true;
                break;
        }
    }
}

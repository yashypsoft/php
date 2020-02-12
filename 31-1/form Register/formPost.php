<?php
require_once 'connect.php';
$validFlag = 0;
connection();
$data =  (isset($_GET['id'])) ? getSQLArray($_GET['id']) : [];

function getData($category, $fieldData, $returnType = "")
{
    global $data;
    if (isset($_POST[$category][$fieldData])) {
        return $_POST[$category][$fieldData];
    } 
    else if ($returnType == []) {
        $arrayData = isset($data[$fieldData])? explode(',', $data[$fieldData]):"";
        return (!empty($data)) ?  $arrayData : $returnType;
    } else {
        $value = isset($data[$fieldData]) ? $data[$fieldData] : ""; 
        return (!empty($data)) ?  $value : $returnType;
    }
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

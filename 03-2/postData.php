<?php
session_start();

$validFlag = 0;

function getData($category, $fieldData, $returnType = "")
{
    global $data;
    if (isset($_POST[$category][$fieldData])) {
        return $_POST[$category][$fieldData];
    } else if ($returnType == []) {
        $arrayData = isset($data[$fieldData]) ? explode(',', $data[$fieldData]) : "";
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
            case 'mobile':
                return (strlen($value) == 10) ? false : true;
                break;
            case 'email':
                return (preg_match('/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/', $value))
                    ? false
                    : true;
                break;
            case 'first_name':
            case 'last_name':
                return  preg_match('/^[a-zA-Z]{1,10}$/', $value)
                    ? false
                    : true;
                break;
            case 'password':
            case 'information':
            case 'title':
            case 'content':
            case 'url':
            case 'published_at':
            case 'meta_title':
                return !empty($value) ? false : true;
                break;
            case 'tnc':
                return (isset($_POST[$section][$fieldname])) ? false : true;
                break;
            case 'confirm_password':
                $pass = isset($_POST['account']['password']) ? $_POST['account']['password'] : "";
                if ($pass != $value) {
                    return false;
                } else {
                    return true;
                }
                break;
            case 'image':
                return (!empty($_FILES[$section]['name'][$fieldname])) ? false : true;
                break;
        }
    }
}


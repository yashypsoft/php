<?php

$conn = "";

function connection()
{
    $mysqlHost = 'localhost';
    $mysqlUser = 'root';
    $mysqlPassword = "";
    $mysqlDatabase = "customer_portal";
    global $conn;
    $conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword, $mysqlDatabase);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        return $conn;
    }
}



function accountData($section)
{
    $account = [];
    foreach ($section as $key => $value) {
        $account[$key] =  $value;
    }
    return $account;
}

function addressData($section)
{
    $address = [];
    foreach ($section as $key => $value) {
        $address[$key] = $value;
    }

    return $address;
}

function otherData($section, $field)
{
    $other = [];
    foreach ($section as $key => $value) {
        if ($key == $field) {
            switch (gettype($value)) {
                case 'array':
                    $value = implode(',', $value);
                    $other['field_key'] = $key;
                    $other['value'] = $value;
                    break;
                case 'string':
                    $other['field_key'] = $key;
                    $other['value'] = $value;
                    break;
            }
        }
    }
    return $other;
}



function insertData($tableName, $ArrayData)
{
    global $conn;
    $valueItemArray = [];
    $ColumnNameArray = [];
    foreach ($ArrayData as $key => $value) {
        array_push($ColumnNameArray, $key);
        array_push($valueItemArray, $value);
    }
    $columnString = implode(',', $ColumnNameArray);
    $valueString = implode("','", $valueItemArray);
    $query = "insert into $tableName ($columnString) VALUES ('$valueString')";
    if ($query_run = mysqli_query($conn, $query)) {
        return mysqli_insert_id($conn);
    }
}

function setMysqlData()
{

    $account = accountData($_POST['account']);
    $address = accountData($_POST['address']);
    $customer_id = insertData('customers', $account);
    $address['customer_id'] = $customer_id;
    $add_id = insertData('customer_address', $address);

    foreach ($_POST['other'] as $key => $value) {
        $other = otherData($_POST['other'],$key);
        $other['customer_id'] = $customer_id;
        insertData('customer_additional_info', $other);
    }
}


function getMysqlData($tableName, $fieldName)
{
    global $conn;
    $query = "select $fieldName from $tableName ";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            foreach ($row as $key => $value ) {
                echo $key . $value;
            }
        }
    }
}


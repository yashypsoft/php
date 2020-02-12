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
        $other = otherData($_POST['other'], $key);
        $other['customer_id'] = $customer_id;
        insertData('customer_additional_info', $other);
    }
}



function fetchAll($tableName, $fieldName)
{
    global $conn;
    $ArrayData = [];
    if ($tableName == "customer_additional_info") {
        $i = 0;
        $query = "select value from $tableName ORDER BY customer_id LIMIT 5 ";
        if ($query_run = mysqli_query($conn, $query)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                foreach ($row as $key => $value) {
                    $ArrayData[$i] = $value;
                    $i++;
                }
            }
        }
    } else {
        $query = "select $fieldName from $tableName ORDER BY customer_id LIMIT 1 ";
        if ($query_run = mysqli_query($conn, $query)) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                foreach ($row as $key => $value) {
                    $ArrayData[$key] = $value;
                }
            }
        }
    }
    return $ArrayData;
}

function displayDatainGrid()
{
    $headData = [];
    $table = "";
    global $conn;
    $query =
        "SELECT 
    c.customer_id id,
    C.firstName,C.lastName,CA.city,
    Hob.value hobbies, GETIN.value getintouch 
    from customers C
    LEFT JOIN customer_address CA ON c.customer_id = ca.customer_id
    LEFT JOIN customer_additional_info Hob ON c.customer_id = hob.customer_id 
    AND hob.field_key = 'hobbies'
    LEFT JOIN customer_additional_info GETIN  ON c.customer_id = getin.customer_id 
    AND getin.field_key = 'getintouch'";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $table .= "<tr>";
            foreach ($row as $key => $value) {
                $table .= "<td>$value</td>";
            }
            $table.= "<td><a href='./?id=$row[id]'>edit</a></td>";
            $table.= "<td><a href='http://localhost/cybercom/php/28-1/form/dataDisplay.php?id=$row[id]'>Delete</a></td>";
            $table .= "</tr>";
        }
    }  
    return $table;
}




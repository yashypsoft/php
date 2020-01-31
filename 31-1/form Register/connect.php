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

function updatesetData($uid)
{
    $account = accountData($_POST['account']);
    $address = accountData($_POST['address']);
    UpdateQuery('customers', $account, $uid);
    $address['customer_id'] = $uid;

    $add_id = UpdateQuery('customer_address', $address, $uid);
    foreach ($_POST['other'] as $key => $value) {
        $other = otherData($_POST['other'], $key);
        UpdateQuery('customer_additional_info', $other, $uid);
    }
}

function UpdateQuery($tableName, $ArrayData, $uid)
{
    global $conn;
    if ($tableName == "customer_additional_info") {
        $query = "UPDATE $tableName SET value = '$ArrayData[value]'   WHERE customer_id = $uid 
            AND field_key = '$ArrayData[field_key]'";
        if ($query_run = mysqli_query($conn, $query)) {
        }
    } else {
        foreach ($ArrayData as $key => $value) {
            $query = "UPDATE $tableName SET $key = '$value' WHERE customer_id = $uid ";
            if ($query_run = mysqli_query($conn, $query)) {
            }
        }
    }
}





function displayDatainGrid()
{
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
            $table .= "<td><a href='./?id=$row[id]'>edit</a></td>";
            $table .= "<td><a href='./dataDisplay.php?id=$row[id]'>Delete</a></td>";
            $table .= "</tr>";
        }
    }
    return $table;
}


function deleteData($uid)
{
    global $conn;
    $query = "
    DELETE C,CA,CO from  customers C
    LEFT JOIN customer_address CA
    ON C.customer_id = CA.customer_id  
    LEFT JOIN customer_additional_info CO
    ON CO.customer_id = C.customer_id
    WHERE C.customer_id =$uid";
    if ($query_run = mysqli_query($conn, $query)) {
        header("location: ./dataDisplay.php ");
    }
}


function getSQLArray($uid)
{
    global $conn;
    $data = [];

    $query =
        "SELECT 
    c.prefix,c.firstName,c.lastName,c.dob,c.phoneNo,c.email,c.password,
    ca.address1,ca.address2,ca.company,ca.company,ca.city,ca.state,ca.contry,ca.postalCode,
    DY.value describeYourself, BYear.value businessYear, NClient.value numberClient,
    GIN.value getintouch, HOB.value hobbies
    from customers C 
    LEFT JOIN customer_address CA ON C.customer_id =CA.customer_id
    LEFT JOIN customer_additional_info DY ON c.customer_id = dy.customer_id 
    AND DY.field_key = 'describeYourself'
    LEFT JOIN customer_additional_info BYear ON c.customer_id = BYear.customer_id 
    AND BYear.field_key = 'businessYear'
    LEFT JOIN customer_additional_info NClient ON c.customer_id = NClient.customer_id 
    AND NClient.field_key = 'numberClient'
    LEFT JOIN customer_additional_info GIN ON c.customer_id = GIN.customer_id 
    AND GIN.field_key = 'getintouch'
    LEFT JOIN customer_additional_info HOB ON c.customer_id = HOB.customer_id 
    AND HOB.field_key = 'hobbies' WHERE c.customer_id = $uid
    ";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            foreach ($row as $key => $value) {
                $data[$key] = $value;
            }
        }
    }

    return ($data);
}

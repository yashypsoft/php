<?php

$conn = "";

function connection()
{
    $mysqlHost = 'localhost';
    $mysqlUser = 'root';
    $mysqlPassword = "";
    $mysqlDatabase = "testdb";
    global $conn;
    $conn = mysqli_connect($mysqlHost, $mysqlUser, $mysqlPassword, $mysqlDatabase);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    } else {
        return $conn;
    }
}

function load($tableName, $fieldName, $id)
{
    $conn = connection();
    $query = "SELECT $fieldName FROM $tableName WHERE id = $id";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($query_run);
    return $data[$fieldName];
}

function fetchAll($tableName)
{
    $conn = connection();
    $query = "SELECT * FROM $tableName";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($query_run);
    return $data;
}

function fetchRow($tableName, $whereArray = null)
{
    $conn = connection();
    $where = whereCondotion($whereArray);
    $query = "SELECT * FROM $tableName $where";
    $query_run = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($query_run);
    return $data;
}

function fetchRr($tableName, $whereArray = null)
{
    $conn = connection();
    $where = whereCondotion($whereArray);
    $query = "SELECT * FROM $tableName $where";
    $query_run = mysqli_query($conn, $query);
    // $data = mysqli_fetch_assoc($query_run);
    return $query_run;
}

function insertData($tableName, $ArrayData)
{
    $conn = connection();
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

function whereCondotion($whereArray)
{
    if ($whereArray != null) {
        $key = array_keys($whereArray);
        $value = array_values($whereArray);
        $where = "WHERE $key[0] = '$value[0]'";
        if (sizeof($whereArray) > 1) {
            for ($cnt = 1; $cnt < sizeof($whereArray); $cnt++) {
                $where .= "AND $key[$cnt] = '$value[$cnt]'";
            }
        }
        return $where;
    } else {
        $where = "";
    }
}

function userData($section)
{
    $user = [];
    foreach ($section  as $key => $value) {
        $user[$key] = $value;
    }
    return $user;
}

function sessionLogArray($lfi, $lgo, $id)
{
    $sessionData['logInTime'] = $lfi;
    $sessionData['logOutTime'] = $lgo;
    $sessionData['id'] = $id;
    return $sessionData;
}

function checkData($value)
{
    $conn = connection();
    $query = "SELECT * FROM users WHERE email = '$value'";
    $queryRun = mysqli_query($conn, $query);
    if ($queryRun->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}


function updateData($tableName, $ArrayData, $id)
{
    $conn = connection();
    $valueItemArray = [];
    $ColumnNameArray = [];
    foreach ($ArrayData as $key => $value) {
        array_push($ColumnNameArray, $key);
        array_push($valueItemArray, $value);
    }
    for ($cnt = 0; $cnt < sizeof($ColumnNameArray); $cnt++) {
        $query = "UPDATE $tableName SET $ColumnNameArray[$cnt] = '$valueItemArray[$cnt]'
         WHERE customer_id = $id ";
        if ($query_run = mysqli_query($conn, $query)) {
            return mysqli_insert_id($conn);
        }
    }
}

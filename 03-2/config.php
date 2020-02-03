<?php

use function PHPSTORM_META\type;

$conn = "";

function connection()
{
    $mysqlHost = 'localhost';
    $mysqlUser = 'root';
    $mysqlPassword = "";
    $mysqlDatabase = "blog_application";
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
    echo $query;
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




function validateEmailPass($email, $password)
{
    $conn = connection();
    $query = "SELECT id FROM user WHERE email = '$email' AND password = '$password'";
    if ($queryRun = mysqli_query($conn, $query)) {
        $data = mysqli_fetch_assoc($queryRun);
        return $data['id'];
    } else {
        return 0;
    }
}

function prepareData($sectionArray)
{
    $data = [];
    foreach ($sectionArray  as $key => $value) {
        if (gettype($value) == 'array') {
            $values = implode(',', $value);
            $data[$key] = $values;
        } else {
            $data[$key] = $value;
        }
    }
    return $data;
}



function listBlogPost($id)
{
    $ArrayData = [];
    $i = 0;
    $conn = connection();    
    $query = "SELECT id,category,title,published_at from blog_post where user_id = $id";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $ArrayData[$i] = $row;
            $i++;
        }
    }
    return $ArrayData;
}

function listCategory($id){
    $ArrayData = [];
    $i = 0;
    $conn = connection();    
    $query = "SELECT id,category,title,published_at from blog_post where user_id = $id";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $ArrayData[$i] = $row;
            $i++;
        }
    }
    return $ArrayData;
}

function displayData($greedData)
{
    $table = "";
    foreach ($greedData as $i => $array) {
        $table .= "<tr>";

        foreach ($array as $key => $value) {
            $table .= "<td>$value</td>";
        }
        $self = $_SERVER['PHP_SELF'];
        $table .= "<td><a href='./?id=$array[id]'>edit</a></td>";
        $table .= "<td><a href='http://localhost$self?id=$array[id]'>Delete</a></td>";
        $table .= "<tr>";
    }
    return $table;
}

function displayColumn($greedData)
{
    $table = "";
    foreach ($greedData as $i => $array) {

        if ($i == 0) {
            foreach ($array as $key => $value) {
                $table .= "<th>$key</th>";
            }
            $table .= "<th colspan='2'>action</th>";
        }
    }
    return $table;
}


function checkEmail($email)
{
    $conn = connection();
    $query = "SELECT * FROM users WHERE email = '$email'";
    $queryRun = mysqli_query($conn, $query);
    if ($queryRun->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

function deletePost($id){
    

    $conn = connection();
    $query = "
    DELETE From blog_post where id= $id ";
    if ($query_run = mysqli_query($conn, $query)) {
        header("location: blogPost.php ");
    }

}



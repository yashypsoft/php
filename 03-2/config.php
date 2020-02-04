<?php

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
    foreach ($ArrayData as $key => $value) {
        $query = "UPDATE $tableName SET $key = '$value' WHERE id = '$id' ";
 
        if ($query_run = mysqli_query($conn, $query)) {
            
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

function listCategory()
{
    $ArrayData = [];
    $i = 0;
    $conn = connection();
    $query = "SELECT id,title,image,created_at from category where parent_category_id	= '0'";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $ArrayData[$i] = $row;
            $i++;
        }
    }
    return $ArrayData;
}

function displayPostData($greedData)
{
    $table = "";
    foreach ($greedData as $i => $array) {
        $table .= "<tr>";
        foreach ($array as $key => $value) {
            if($key=='id'){
                $table .= "<td><a href='./viewblog.php/?postid=$value'>$value</a></td>";

            }else{
                $table .= "<td>$value</td>";
            }  
        }
        $self = $_SERVER['PHP_SELF'];
        $table .= "<td><a href='./addpost.php/?id=$array[id]'>edit</a></td>";
        $table .= "<td><a href='http://localhost/$self?id=$array[id]'>Delete</a></td>";
        $table .= "<tr>";
    }
    return $table;
}

function displayCategoryData($greedData)
{
    $table = "";
    foreach ($greedData as $i => $array) {
        $table .= "<tr>";

        foreach ($array as $key => $value) {
            if($key=='image'){
                $table .= "<td><img src='./Category/$value' alt='$value' width='120px'></td>";

            }else{
                $table .= "<td>$value</td>";
            }  
        }
        $self = $_SERVER['PHP_SELF'];
        $table .= "<td><a href='./addCategory.php/?id=$array[id]'>edit</a></td>";
        $table .= "<td><a href='http://localhost/$self?id=$array[id]'>Delete</a></td>";
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
    $query = "SELECT * FROM user WHERE email = '$email'";
    $queryRun = mysqli_query($conn, $query);
    if ($queryRun->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

function deleteData($tableName,$id)
{
    $conn = connection();
    $query = "DELETE From $tableName where id= $id ";
    if ($query_run = mysqli_query($conn, $query)) {
        return 1;
    }
}


function getEditData($tableName,$id)
{
    $conn = connection();
    $data = [];
    $query = "SELECT * FROM $tableName WHERE id = $id";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            foreach ($row as $key => $value) {
                $data[$key] = $value;
            }
        }
    }

    return ($data);
}

function fetch($tableName,$whereArray=null){
    $conn = connection();
    $i=0;
    $data = [];
    $where = whereCondotion($whereArray);
    $query = "SELECT * FROM $tableName $where";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            foreach ($row as $key => $value) {
                $data[$i][$key] = $value;
            }
            $i++;
        }
    }

    return ($data);
}
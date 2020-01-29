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

function insertMysqlData($tableName, $section)
{
    ($values = $_POST[$section]);
    $valueItemArray = [];
    $ColumnNameArray = [];
    global $conn;
    foreach ($values as $column => $value) {
        array_push($valueItemArray, $value);
        array_push($ColumnNameArray, $column);
    }
  
    $columnString = implode(',', $ColumnNameArray);
    $valueString = implode("','", $valueItemArray);
    $cid ="";
    if($section!='account'){
    $queryForCustomerId ='select customer_id from customers  ORDER BY customer_id DESC LIMIT 1';
    $customer_id = mysqli_fetch_assoc(mysqli_query($conn,$queryForCustomerId))['customer_id'] ;
    $cid = $customer_id;
    }
    $query = "insert into $tableName (customer_id,$columnString) VALUES ('$cid','$valueString')";
    if ($query_run = mysqli_query($conn, $query)) {
        echo "Success";
    } else {
        echo mysqli_error($conn);
    }
}

if (connection()) {
    insertMysqlData('customers', 'account');
    insertMysqlData('customer_address', 'address');

}

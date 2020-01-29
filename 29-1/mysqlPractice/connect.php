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

function fetchAll($fieldName, $tableName)
{
    global $conn;
    $query = "select $fieldName from $tableName ";
    if ($query_run = mysqli_query($conn, $query)) {
        echo "<table border='1'>";
        while ($row = mysqli_fetch_assoc($query_run)) {
            echo '<tr>';
            foreach ($row as $field => $item) {
                echo "<td>$item</td>";
            }
            echo '</tr>';
        }
        echo '</table>';
    }
}
function fetchRow($fieldName, $tableName, $rowNo)
{
    global $conn;
    $query = "select $fieldName from $tableName where id = $rowNo";
    if ($query_run = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            foreach ($row as $field => $item) {
                echo $item;
                echo '<br>';
            }
        }
    }
}

function setData($tableName, array $fieldName)
{
    global $conn;
    if (
        isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['gender'])
        && !empty($_POST['address']) && !empty($_POST['phone'])
    ) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $field = implode(',', $fieldName);
        $query = "insert into $tableName ($field) VALUES  
                ('','$name','$gender','$address','$phone')";
        if ($query_run = mysqli_query($conn, $query)) {
            echo "Success";
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo "enter in filed";
    }
}

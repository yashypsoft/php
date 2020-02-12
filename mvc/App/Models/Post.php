<?php

namespace App\Models;

use PDO;
use PDOException;

class Post extends \Core\Model
{

    public $errArray = [];
    public function getAll($tableName)
    {
        $query = "select * from $tableName order by date desc";
        if ($query_run = mysqli_query($this->conn, $query)) {
            return $query_run;
        }
    }

    function insertData($tableName, $data)
    {

        $valueItemArray = [];
        $ColumnNameArray = [];

        foreach ($data as $key => $value) {
            array_push($ColumnNameArray, $key);
            array_push($valueItemArray, $value);
        }

        $columnString = implode(',', $ColumnNameArray);
        $valueString = implode("','", $valueItemArray);

        $query = "insert into $tableName ($columnString) VALUES ('$valueString')";

        if ($query_run = mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn);
        }
    }

    function fetchRow($tableName, $whereArray = null)
    {
        $where = $this->whereCondotion($whereArray);

        $query = "SELECT * FROM $tableName $where";

        $query_run = mysqli_query($this->conn, $query);
        $data = mysqli_fetch_assoc($query_run);

        return $data;
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

    function UpdateQuery($tableName, $ArrayData, $whereArray = [])
    {
        $where = $this->whereCondotion($whereArray);
        foreach ($ArrayData as $key => $value) {
            $query = "UPDATE $tableName SET $key = '$value' $where";
            if ($query_run = mysqli_query($this->conn, $query)) {

            }
        }
    }

    function deleteData($tableName, $whereArray = [])
    {
        $where = $this->whereCondotion($whereArray);
        $query = "DELETE FROM $tableName $where";
        if ($query_run = mysqli_query($this->conn, $query)) {
        }
    }



    public function validate($fieldData)
    {
        foreach ($fieldData as $key => $value) {

            switch ($key) {
                case 'title':
                    if (empty($value)) {
                        $this->errArray[$key] = 'Title is required';
                        break;
                    }
                case 'content':
                    if (empty($value)) {
                        $this->errArray[$key] = 'content is required';
                        break;
                    }
            }
        }

        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }
    }

    function getErrors()
    {
        return $this->errArray;
    }
}

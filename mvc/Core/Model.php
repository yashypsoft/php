<?php

namespace Core;
 
abstract  class Model
{
    protected $conn = "";
  
    function __construct()
    {
        if ($this->conn === "") {
            $host = "localhost";
            $dbname = "testdb";
            $username = "root";
            $password = "";
            $this->conn = mysqli_connect($host, $username, $password, $dbname);
            if ($this->conn) {
            } else {
                die("connection failed" . mysqli_connect_error());
            }
        }
    }  
    
}

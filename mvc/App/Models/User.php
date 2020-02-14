<?php

namespace App\Models;

use PDO;

class User extends \Core\Model{

    public $errArray = [];

    public function validate($fieldData)
    {
        foreach ($fieldData as $key => $value) {

            switch ($key) {
                case 'name':
                    if (empty($value)) {
                        $this->errArray[$key] = 'Name is required';
                    }
                    break;
                case 'password':
                    if (empty($value)) {
                        $this->errArray[$key] = 'Password is required'; 
                    }
                    break;
                case 'mobile':
                    if(strlen($value)!=10){
                        $this->errArray[$key] = 'Mobile Number must be 10 character'; 
                    }
                    break;
                case 'email':
                    if(!preg_match('/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/',$value)){
                        $this->errArray[$key] = 'Enter valid email'; 
                    }
                    break;
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



    public function checkData($tableName,$key,$data){

        $conn = self::getDB();

        $query = "SELECT COUNT($key) FROM $tableName WHERE $key ='$data' ";

        $stmt =$conn->query($query);

        $numOfRow = $stmt->fetchColumn();

        if($numOfRow>=1){
            return true;
        }
        else{
            return false;
        }
        
    }

}
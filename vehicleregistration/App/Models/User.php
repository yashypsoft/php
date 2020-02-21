<?php

namespace App\Models;

use PDO;

class User extends \Core\Model
{

    public $errArray = [];

    public function prepareUserData($postData)
    {
        $userData = [];
        foreach ($postData as $key => $value) {
            switch ($key) {
                case 'firstName':
                    $userData['first_name'] = $value;
                    break;
                case 'lastName':
                    $userData['last_name'] = $value;
                    break;
                case 'firstName':
                    $userData['first_name'] = $value;
                    break;
                case 'email':
                    $userData['email'] = $value;
                    break;
                case 'password':
                    $userData['password'] = md5($value);
                    break; 
                case 'phoneNo':
                    $userData['phone_number'] = $value;
                    break;    
            }
        }
        return $userData;
    }

    public function prepareUserAddressData($postData)
    {
        $userAddressData = [];
        foreach ($postData as $key => $value) {
            switch ($key) {     
                case 'street':
                    $userAddressData['street'] = $value;
                    break;
                case 'city':
                    $userAddressData['city'] = $value;
                    break; 
                case 'state':
                    $userAddressData['state'] = $value;
                    break;
                case 'zipcode':
                    $userAddressData['zipcode'] = $value;
                    break; 
                case 'country':
                    $userAddressData['country'] = $value;
                    break;     
            }
        }
        return $userAddressData;
    }

    public function validate($fieldData)
    {
        foreach ($fieldData as $key => $value) {

            switch ($key) {
                case 'firstName':
                case 'lastName':
                case 'street':
                case 'city':
                case 'state': 
                case 'country':  
                case 'password':
                    if (empty($value)) {
                        $this->errArray[$key] = "$key is required";
                    }
                    break;
                case 'phoneNo':
                    if (strlen($value) != 10) {
                        $this->errArray[$key] = 'Phone Number must be 10 character';
                    }
                    break;
                case 'email':
                    if (!preg_match(
                        '/^[\\w\\-]+(\\.[\\w\\-]+)*@([A-Za-z0-9-]+\\.)+[A-Za-z]{2,4}$/',
                        $value
                    )) {
                        $this->errArray[$key] = 'Enter valid email';
                    }
                    break;
                case 'zipcode':
                    if (strlen($value) != 6) {
                        $this->errArray[$key] = 'Zip Code must be 6 character';
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


    
}

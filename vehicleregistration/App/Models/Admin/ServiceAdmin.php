<?php

namespace App\Models\Admin;

use PDO;
class ServiceAdmin extends \Core\Model
{
    public $errArray = [];

    public function prepareServiceData($postData)
    {
        $serviceData = [];
        foreach ($postData as $key => $value) {
            switch ($key) {
                case 'title':
                    $serviceData['title'] = $value;
                    break;
                case 'vehicleNumber':
                    $serviceData['vehicle_number'] = $value;
                    break;
                case 'licenceNumber':
                    $serviceData['licence_number'] = $value;
                    break;
                case 'date':
                    $serviceData['date'] = $value;
                    break;
                case 'timeSlot':
                    $serviceData['time_slot'] = ($value);
                    break; 
                case 'vehilceIssue':
                    $serviceData['vehicle_issue'] = $value;
                    break;  
                case 'serviceCenter':
                    $serviceData['service_center'] = $value;
                    break; 
                case 'userId':
                    $serviceData['user_id'] = $value;
                break; 
            }
        }
        return $serviceData;
    }

    public function validate($fieldData)
    {
        foreach ($fieldData as $key => $value) {

            switch ($key) {
                case 'title':
                case 'vehilceIssue':
                case 'serviceCenter':
                    if (empty($value)) {
                        $this->errArray[$key] = "$key is required";
                    }
                    break;
                case 'date':
                    if (date('Y-m-d') > $value) {
                        $this->errArray[$key] = "Inavlid date";
                    }
                    break;
                case 'licenceNumber':
                    if ((!preg_match('/^[0-9a-zA-Z]{4,9}$/',$value))) {
                        $this->errArray[$key] = 'Enter valid Licence Number';
                    }
                    break;
                case 'vehicleNumber':
                    if ((!preg_match('/^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/',$value))) {
                        $this->errArray[$key] = 'Enter valid Vehicle Number';
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
    function checkTimeSlot($timeslot,$date){
        $conn = static::getDB();
        $query = "SELECT COUNT(time_slot) FROM service_registrations WHERE 
            time_slot = '$timeslot' AND date = '$date'";

        $stmt = $conn->query($query);
        $result = $stmt->fetch(); 
        return $result;
    }

    
    function getErrors()
    {
        return $this->errArray;
    }
}
<?php

namespace App\Controllers;

use App\Models\Service;
use Core\View;

class Services extends  \Core\Controller{

    public function indexAction(){
        $serviceObj = new Service();
        $userId = isset($_SESSION['user']['user_id'])?$_SESSION['user']['user_id']:"";
        $displayData = $serviceObj->getFieldData('service_registrations','*',
            ['user_id'=>$userId]);
        view::renderTemplate('user/services/index.html',['displayData'=>$displayData]);
    }

    public function addAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $serviceObj = new Service();
            $serviceData = $_POST['service'];
            if ($serviceObj->validate($serviceData)) {
                $checkTimeSlot = $serviceObj->
                    checkTimeSlot($serviceData['timeSlot'],$serviceData['date']);

                if($checkTimeSlot['COUNT(time_slot)']>3){
                    View::renderTemplate(
                        'user/services/add.html',
                        ['timeslot' => 'TimeSlot  3 per day already assigned']
                    );
                }else{
                    $id = $serviceObj->insertData('service_registrations',
                    $serviceObj->prepareServiceData($serviceData));;
                    header("Location:../services/index");
                }
               
            } else {
                $error = $serviceObj->getErrors();
                View::renderTemplate(
                    'user/services/add.html',
                    ['errData' => $error]
                );
            }
        
        } else {
            View::renderTemplate('user/services/add.html');
        }
    }
 

    function before()
    {
        if(isset($_SESSION['user'])){
            return true;
        }
        else{
            header("Location:../users/login");
        }
    }

   
}


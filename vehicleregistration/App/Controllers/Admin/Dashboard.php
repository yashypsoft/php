<?php

namespace App\Controllers\Admin;

use App\Models\admin\ServiceAdmin;
use Core\View;

class Dashboard extends \Core\Controller {

    public function indexAction(){
        $serviceObj = new ServiceAdmin();
        $displayData = $serviceObj->getFieldData('service_registrations','*');
        view::renderTemplate('admin/index.html',['displayData'=>$displayData]);
    }


    public function editAction()
    {
        $serviceObj = new ServiceAdmin();
        $id = $this->route_params['id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          
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
                    $id = $serviceObj->updateQuery('service_registrations',
                    $serviceObj->prepareServiceData($serviceData),['service_id'=>$id]);;
                    header("Location:../index");
                }
               
            } else {
                $error = $serviceObj->getErrors();
                View::renderTemplate(
                    'user/services/add.html',
                    ['errData' => $error]
                );
            }
        
        } else {
            $id = $this->route_params['id'];
            $editData = $serviceObj->fetchRow('service_registrations', ['service_id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                View::renderTemplate('user/services/add.html', ['editData' => $editData]);
               
            }
        }
            
        
    }
    public function deleteAction()
    {
        $serviceObj = new ServiceAdmin();
        $id = ($this->route_params['id']);
        $serviceObj->deleteData('service_registrations', ['service_id' => $id ]);
        header("Location: ../index");
    }
}
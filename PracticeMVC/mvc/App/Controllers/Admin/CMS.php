<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Cmsmodel;
use Core\View;

class Cms extends \Core\Controller
{
    public function indexAction(){
        
        $cmsObj = new Cmsmodel();
        $cmsData = $cmsObj -> getAll('cms_pages');    
        View::renderTemplate('admin/cms/index.html',['cmsData' => $cmsData]);
    }

    public function addAction(){
        $cmsObj = new Cmsmodel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['cms'];

            if ($cmsObj->validate($data) && $cmsObj->checkUrl()) {
                $cmsObj->insertData('cms_pages',$cmsObj->prepareCmsData($data));
                header("Location:../cms/index"); 
            } else {
                $error = $cmsObj->getErrors(); 
    
                View::renderTemplate(
                    'admin/cms/add.html',
                    ['errData' => $error]
                );
            }    
        }
        else{

            View::renderTemplate('admin/cms/add.html');
        } 
    }

    public function editAction()
    {
        $cmsObj = new Cmsmodel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['cms'];
          
            if ($cmsObj->validate($data)) {
                $cmsObj->updateQuery('cms_pages',
                     $cmsObj->prepareCmsData($data), ['id' => $data['id']]);
                header("Location:../index");
            } else {
                $error = $cmsObj->getErrors();
                View::renderTemplate(
                    'admin/cms/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $cmsObj->fetchRow('cms_pages', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                View::renderTemplate('admin/cms/add.html',
                     ['editData' => $editData]);
            }
        }
    }
    public function deleteAction()
    {
        $cmsObj = new Cmsmodel();
        $id = ($this->route_params['id']);
        $cmsObj->deleteData('cms_pages', ['id' => $id ]);
        header("Location: ../index");
    }

    function showAction(){
        $routeKey = $this->route_params['urlkey'];
        $cmsObj = new Cmsmodel();
        $displayData = $cmsObj->getFieldData('cms_pages','*',['url_key'=>$routeKey,'status'=>'ON']);
        view::renderTemplate('admin/cms/show.html',['displayData'=>$displayData[0]]);
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

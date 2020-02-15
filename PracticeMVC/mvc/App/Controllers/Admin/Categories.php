<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Category;
use Core\View;

class Categories extends \Core\Controller
{
    function indexAction(){

        $categoryObj = new Category();
        $categoryData = $categoryObj -> getAll('categories');    

        view::renderTemplate('admin/Categories/index.html',['categoryData'=>$categoryData]);
    }

    function addAction(){
        $categoryObj = new Category();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['categories'];
             $checkFileValidation  =
            $categoryObj->fileUpload('categories','image',Config::CATEGORIESPATH);
            if ($categoryObj->validate($data) && $checkFileValidation ) {
        
                $categoryObj->insertData('categories',$categoryObj->prepareCategoryData($data));
                header("Location:../categories/index"); 
            } else {
                
                $error = $categoryObj->getErrors();
                $parentCategory = 
                $categoryObj -> getFieldData('categories','category_name,id',['parent_category'=>'0']);
                View::renderTemplate(
                    'admin/categories/add.html',
                    ['errData' => $error,'parentCategory'=>$parentCategory]
                );
            }
            
        }
        else{
           
            $parentCategory = 
                 $categoryObj -> getFieldData('categories','category_name,id',['parent_category'=>'0']);
            View::renderTemplate('admin/categories/add.html',['parentCategory'=>$parentCategory]);
        } 
    }   

    function editAction()
    {
        $categoryObj = new Category();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['categories'];
            $checkFileValidation  =
            $categoryObj->fileUpload('categories','image',Config::CATEGORIESPATH);
            if ($categoryObj->validate($data) && $checkFileValidation) {
                $categoryObj->updateQuery('categories',
                     $categoryObj->prepareCategoryData($data), ['id' => $data['id']]);
          
                header("Location:../admin/categories/index");
            } else {
                $error = $categoryObj->getErrors();
                View::renderTemplate(
                    'admin/categories/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $categoryObj->fetchRow('categories', ['id' => $id]);
            if ($editData == []) {
                header("Location:../index");
            } else {
                $parentCategory = 
                $categoryObj -> getFieldData('categories','category_name,id',['parent_category'=>'0']);
                View::renderTemplate('admin/categories/add.html',
                     ['editData' => $editData,'parentCategory'=>$parentCategory]);
            }
        }
    }

    function deleteAction(){
        $categoryObj = new Category();
        $id = ($this->route_params['id']);
        $categoryObj->deleteData('categories', ['id' => $id ]);
        $categoryObj->deleteData('categories', ['parent_category'=>$id]);
        header("Location: ../index");
    }

    function showAction(){
        $routeKey = $this->route_params['urlkey'];
       
        $categoryObj = new Category();
        $displayData = $categoryObj->getFieldData('categories','*',['url_key'=>$routeKey,'status'=>'ON']);
      
        view::renderTemplate('admin/categories/show.html',['displayData'=>$displayData[0]]);
    }
}
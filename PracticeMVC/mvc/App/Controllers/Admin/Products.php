<?php

namespace App\Controllers\Admin;

use App\Config;
use App\Models\Admin\Product;
use Core\View;

class Products extends  \Core\Controller
{

    function indexAction(){
        $productObj = new Product();
        $productData = $productObj -> getAll('products');    

        view::renderTemplate('admin/products/index.html',['productData'=>$productData]);
    }
    
    function addAction(){
        $productObj = new Product();
        $categories = 
        $productObj -> getFieldData('categories','category_name,id',['parent_category !'=>'0']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['products'];
             $checkFileValidation  =
            $productObj->fileUpload('products','image',Config::PRODUCTPATH);
            if ($productObj->validate($data) && $checkFileValidation ) {
        
                $productId = 
                $productObj->insertData('products',$productObj->prepareProductData($data));

                //create data for product ctaegories table
                $productCateData = ['product_id'=>$productId,
                    'category_id'=>$_POST['productsCategories']['categoryId']];

                $productObj->insertData('products_categories',$productCateData);

                header("Location:../products/index"); 

            } else {
                
                $error = $productObj->getErrors();
           
                View::renderTemplate(
                    'admin/products/add.html',
                    ['errData' => $error,'categories'=>$categories]
                );
            }     
        }
        else{             
            View::renderTemplate('admin/products/add.html',['categories'=>$categories]);
        } 
    }

    function editAction()
    {
        $productObj = new Product();
        $categories = 
        $productObj -> getFieldData('categories','category_name,id',['parent_category !'=>'0']);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['products'];
            $checkFileValidation  =
            $productObj->fileUpload('products','image',Config::CATEGORIESPATH);
            if ($productObj->validate($data) && $checkFileValidation) {
                $productObj->updateQuery('products',
                     $productObj->prepareProductData($data), ['id' => $data['id']]);

                //create data for product ctaegories table
                $productCateData = ['product_id'=> $data['id'],
                 'category_id'=>$_POST['productsCategories']['categoryId']];

                $productObj->updateQuery('products_categories',$productCateData,['product_id'=>$data['id']]);

                header("Location:../index");
            } else {
                $error = $productObj->getErrors();
                View::renderTemplate(
                    'admin/products/add.html',
                    ['errData' => $error ,'categories'=>$categories]
                );
            }
        } else {
            $id = $this->route_params['id'];
            $editData = $productObj->getEditProductData($id);

            if ($editData == []) {
                header("Location:../index");
            } else {
                View::renderTemplate('admin/products/add.html',
                     ['editData' => $editData,'categories'=>$categories]);
            }     
        }    
    }

    function deleteAction(){
        $productObj = new Product();
        $id = ($this->route_params['id']);
        $productObj->deleteData('products', ['id' => $id ]);
        header("Location: ../index");
    }

    function showAction(){
        $routeKey = $this->route_params['urlkey'];
        $productObj = new Product();
        $displayData = $productObj->getFieldData('products','*',['url_key'=>$routeKey,'status'=>'ON']);
        view::renderTemplate('admin/products/show.html',['displayData'=>$displayData[0]]);
    }
}
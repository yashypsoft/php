<?php

namespace App\Controllers;


use App\Models\Users\Product as UserProduct;
use App\Models\Users\Category as UserCategory;
use \Core\View;


class Product extends \Core\Controller{

    function viewAction(){

        //for navbbar catgories
        $categoryObj = new UserCategory();
        $categoryData = $categoryObj -> getFieldData('categories','*');  
     

        $routeKey = $this->route_params['urlkey'];

        $userProductObj = new UserProduct();
        $productData = $userProductObj->getFieldData('products','*',['url_key'=>$routeKey]);

        view::renderTemplate('user/product/view.html',['productData'=>$productData[0],'categories' => $categoryData]);
    }

    

}
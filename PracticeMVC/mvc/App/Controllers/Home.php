<?php

namespace App\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Cmsmodel;
use \Core\View;

class Home extends \Core\Controller
{

    public function indexAction()
    {
        $categoryObj = new Category();
        $categoryData = $categoryObj -> getFieldData('categories','*',['parent_category'=>0]);   
        // echo "hello from Home class ";
        View::renderTemplate('Home/index.html',[
          'categories' => $categoryData
        ]);
    }

    public function showAction()
    {
      $routeKey = $this->route_params['urlkey'];
      $cmsObj = new Cmsmodel();
      $displayData = $cmsObj->getFieldData('cms_pages','*',['url_key'=>$routeKey,'status'=>'ON']);
      view::renderTemplate('home/show.html',['displayData'=>$displayData[0]]);
    }
    

   
}

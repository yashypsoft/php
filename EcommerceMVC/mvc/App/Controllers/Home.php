<?php

namespace App\Controllers;

use App\Models\Admin\Category;
use App\Models\Admin\Cmsmodel;
use App\Models\Users\Category as UserCategory;

use \Core\View;

class Home extends \Core\Controller
{

    public function showAction()
    {            
        $routeKey = $this->route_params['urlkey'];
        $cmsObj = new Cmsmodel();
        $displayData = $cmsObj->getFieldData('cms_pages','*',['url_key'=>$routeKey,'status'=>'ON']);
        view::renderTemplate('user/show.html',['displayData'=>$displayData[0]]);
    }
 
}

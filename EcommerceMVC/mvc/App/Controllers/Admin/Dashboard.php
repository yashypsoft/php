<?php

namespace App\Controllers\Admin;

use Core\View;

class Dashboard extends \Core\Controller {

    function indexAction()
    {
        View::renderTemplate('admin/dashboard/index.html');

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
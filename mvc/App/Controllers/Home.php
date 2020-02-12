<?php

namespace App\Controllers;

use \Core\View;

class Home extends \Core\Controller
{

    public function indexAction()
    {
        // echo "hello from Home class ";
        View::renderTemplate('Home/index.html',[
            "name" => "Yash",
            "colors" => ['red','blue','green']
        ]);
    }

    protected function before()
    {
        // echo "(before)";
        // return false;
    }

    protected function after()
    {
        // echo "(after)";
    }
}

<?php

namespace App\Controllers\Admin;

use App\Models\Admin\User;


use Core\View;

class Users extends  \Core\Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['users'];
            if ($userObj->validate($data)) {

                $checkEmail =   $userObj->checkData('admin','email',$data['email']);
                $checkPassword = $userObj->checkData('admin','password',$data['password']);
                $userData = $userObj->fetchRow('admin',['email'=>$data['email'],
                                'password'=>$data['password']]);
                $_SESSION['user'] = $userData; 

                if($checkEmail && $checkPassword){ 
                 
                    View::renderTemplate(
                        'admin/login.html',
                        ['user' => $userData]
                    );
                    header("Location: ../categories/index");  
                
                }else{
                    View::renderTemplate(
                        'admin/login.html',
                        ['loginErr' => "Enter valid email And password"  ]
                    );
                }

            }
            else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'admin/login.html',
                    ['errData' => $error]
                );
            }
        }
        else{
            View::renderTemplate('\admin\login.html');
        }
    }

    function logout(){
        unset($_SESSION['user']);
        header("Location: ../.."); 
    }
   
}

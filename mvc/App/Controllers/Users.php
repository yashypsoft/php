<?php

namespace App\Controllers;


use App\Models\User;
use \Core\View;





class Users extends \Core\Controller
{
    
    function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['users'];
            if ($userObj->validate($data)) {

                $checkEmail =   $userObj->checkData('users','email',$data['email']);
                $checkPassword = $userObj->checkData('users','password',$data['password']);
                $userData = $userObj->fetchRow('users',['email'=>$data['email'],
                                'password'=>$data['password']]);
                
                

                if($checkEmail && $checkPassword){ 
                 
                    View::renderTemplate(
                        'users/login.html',
                        ['user' => $userData]
                    );
                    // header("Location:../Posts/index");  
                
                }else{
                    View::renderTemplate(
                        'users/login.html',
                        ['loginErr' => "Enter valid email And password"  ]
                    );
                }

            }
            else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'users/login.html',
                    ['errData' => $error]
                );
            }
        }
        else{
            View::renderTemplate('\Users\login.html');
        }
    }
    function registerAction()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['users'];

            if ($userObj->validate($data)) {

                $checkEmail = $userObj->checkData('users','email',$data['email']);
                if($checkEmail){
                    View::renderTemplate(
                        'users/register.html',
                        ['checkEmail' => 'Email already registered']
                    );
                }
                else{
                    $id = $userObj->insertData('users', $data);
                    $_SESSION['id'] = $id;
                    View::renderTemplate(
                        'base.html',
                        ['id' => $id]
                    );
                    header("Location:../Posts/index");
                }
               
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'users/register.html',
                    ['errData' => $error]
                );
            }
            
        } else {
            View::renderTemplate('users/register.html');
        }
    }
}

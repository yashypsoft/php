<?php

namespace App\Controllers;

use App\Models\User;


use Core\View;

class Users extends  \Core\Controller
{
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $data = $_POST['users'];
            if ($userObj->validate($data)) {

                $checkEmail =   $userObj->checkData('users','email',$data['email']);
                $checkPassword = $userObj->checkData('users','password',md5($data['password']));
                $userData = $userObj->fetchRow('users',['email'=>$data['email'],
                                'password'=>md5($data['password'])]);
                $_SESSION['user'] = $userData; 

                if($checkEmail && $checkPassword){ 
                 
                    View::renderTemplate(
                        '\user\login.html',
                        ['user' => $userData]
                    );
                    header("Location: ../services/index");  
                
                }else{
                    View::renderTemplate(
                        'user/login.html',
                        ['loginErr' => "Enter valid email And password"  ]
                    );
                }

            }
            else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'user/login.html',
                    ['errData' => $error]
                );
            }
        }
        else{
            View::renderTemplate('user/login.html');
        }
    }

    function registerAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $userObj = new User();
            $userData = $_POST['users'];
            $userAddressData = $_POST['usersAddress'];
       
            $validAddData = $userObj->validate($userAddressData);

            if ($userObj->validate($userData) && $validAddData) {

                $checkEmail = $userObj->checkData('users','email',$userData['email']);
                
                if($checkEmail){
                    View::renderTemplate(
                        'user/register.html',
                        ['checkEmail' => 'Email already registered']
                    );
                }
                else{
                    $id = $userObj->insertData('users', $userObj->prepareUserData($userData));
                    $preparedAddressData = $userObj->prepareUserAddressData($userAddressData);
                    $preparedAddressData['user_id']= $id;
                    $userObj->insertData ('user_addresses',$preparedAddressData);
                    header("Location:../users/login");
                }
               
            } else {
                $error = $userObj->getErrors();
                View::renderTemplate(
                    'user/register.html',
                    ['errData' => $error]
                );
            }
            
        } else {
            View::renderTemplate('user/register.html');
        }
    }


    function logout(){
        unset($_SESSION['user']);
        header("Location: ../"); 
    } 

   
}

<?php

namespace App\Controllers;

use App\Models\Post;
use \Core\View;

class Posts extends \Core\Controller
{

    public function indexAction()
    {
        $postObj = new Post();
        $posts = $postObj->getAll('posts');
        View::renderTemplate('Posts/index.html', [
            "posts" => $posts
        ]);
    }

    public function addAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $postObj = new Post();
            $data = $_POST['post'];

            if ($postObj->validate($data)) {
                $postObj->insertData('posts', $data);
                header("Location:../Posts/index");
            } else {
                $error = $postObj->getErrors();
                View::renderTemplate(
                    'Posts/add.html',
                    ['errData' => $error]
                );
            }
        } else {
            View::renderTemplate('Posts/add.html');
        }
    }

    public function editAction()
    {
        
        $postObj = new Post();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST['post'];
            if ($postObj->validate($data)) {    
                $postObj->UpdateQuery('posts', $data,['id'=>$data['id']]);
                header("Location:../Posts/index");
            } else {
                $error = $postObj->getErrors();
                View::renderTemplate(
                    'Posts/add.html',
                    ['errData' => $error]
                );
            }
        } else {      
            $id = $this->route_params['id'];
            $editData = $postObj->fetchRow('posts', ['id' => $id]);
            View::renderTemplate('Posts/add.html', ['editData' => $editData]);
        }
    }

    public function deleteAction()
    {
        $postObj = new Post();
        $id = ($this->route_params['id']);
        $postObj->deleteData('posts', ['id' => $id]);
        header("Location: ../index");
    }
}

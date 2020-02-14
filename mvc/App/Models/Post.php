<?php

namespace App\Models;

use PDO;

class Post extends \Core\Model
{
    public $errArray = [];

    public function validate($fieldData)
    {
        foreach ($fieldData as $key => $value) {

            switch ($key) {
                case 'title':
                    if (empty($value)) {
                        $this->errArray[$key] = 'Title is required';
                        break;
                    }
                case 'content':
                    if (empty($value)) {
                        $this->errArray[$key] = 'Content is required';
                        break;
                    }
            }
        }

        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }
    }

    function getErrors()
    {
        return $this->errArray;
    }
}

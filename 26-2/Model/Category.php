<?php

require_once '../row.php';

class Category extends Row
{
    public function __construct()
    {
        $this->setTableName = "categories";
        $this->setPrimaryKey= "id";
    }
}

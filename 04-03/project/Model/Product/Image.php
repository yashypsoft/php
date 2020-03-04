<?php

namespace Model\Product;

class Image extends \Model\Core\Row
{ 
    public function __construct()
    {
        $this->setTableName('products_image');
        $this->setPrimaryKey('id');
        $this->setAdapter();
    }
}
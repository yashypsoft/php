<?php

require_once '../row.php';

class Product extends Row{
    public function __construct()
    {
        $this->setTableName("products");
        $this->setPrimaryKey("id");
        $this->setAdapter();
    }
}

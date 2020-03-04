<?php

require_once '../Model/Product.php';
require_once '../request.php';

echo "<pre>";
$product = new Product();
$req = new Request();

print_r($product);
$product->setData($req->getPost());

$product->insert();

// header('Location: ../Product/Product_display.php');

print_r($product);

echo "</pre>";
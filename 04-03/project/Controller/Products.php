<?php

namespace Controller;

use Model\Core\Request;
use Model\Product;

class Products extends \Controller\Core\Base
{
    protected $product = NULL;
    protected $products = NULL;
    protected $productImage = NULL;

    function __construct()
    {
        $this->setRequest();
    }

    public function setProduct($product)
    {
        $this->product = $product;
        return $this;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProductImage($productImage)
    {
        $this->productImage = $productImage;
        return $this;
    }

    public function getProductImage()
    {
        return $this->productImage;
    }


    public function setProducts($products)
    {
        $this->products = $products;
        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function addAction()
    {
        $product = new Product();
        $this->setProduct($product);
        $status = $product->getStatusOption();
        require_once 'View/product/add.php';
    }

    public function viewAction()
    {
        $product = new Product();
        $collection = $product->fetchAll();
        $this->setProducts($collection);
        require_once 'View/product/view.php';
    }

    public function mediaGalleryAction()
    {
        try {
            $product = new Product();
            $image = new \Model\Product\Image();

            $prodctId = (int) $this->getRequest()->getRequest('id');
            if (!$prodctId) {
                throw new Exception("Id not found");
            }
            $product = $product->load($prodctId);
            if (!$product) {
                throw new Exception("Record not found");
            }

            $this->setProductImage($image->fetchAll());
            $this->setProduct($product);
            require_once 'View/product/mediaGallery.php';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function saveImageAction()
    {
        try {
            $product = new Product();
            $prodctId = (int) $this->getRequest()->getRequest('id');
            if (!$prodctId) {
                throw new Exception("Invalid Request");
            }
            $product = $product->load($prodctId);
            if (!$product) {
                throw new Exception("Record not found.");
            }

            if (!array_key_exists('image', $_FILES)) {
                throw new Exception("Image not set.");
            }

            $product->uploadImage($_FILES['image']);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editAction()
    {
        try {
            $product = new Product();
            $prodctId = (int) $this->getRequest()->getRequest('id');

            if (!$prodctId) {
                throw new Exception("Id not found");
            }
            $product = $product->load($prodctId);
            if (!$product) {
                throw new Exception("Record not found");
            }
            $this->setProduct($product);

            require_once  'View/product/add.php';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Post is not set");
            }
            $product = new Product();

            if ($id = (int) $this->getRequest()->getRequest('id')) {
                if (!$product->load($id)) {
                    throw new Exception("Record not found");
                }
            }
            $product->setData($this->getRequest()->getPost());
            $product->save();
            $this->redirect('products', 'view');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function deleteAction()
    {
        try {
            $product = new Product();
            $productIds = $this->getRequest()->getPost()['deleteId'];
            foreach ($productIds as $productId) {
                if (!$productId) {
                    throw new Exception("Id not found");
                }
                if (!$product->load($productId)) {
                    throw new Exception("Record not found");
                }
                $product->delete();
            }
            $this->redirect('products', 'view');
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

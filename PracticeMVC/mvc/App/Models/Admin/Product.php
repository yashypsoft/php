<?php

namespace App\Models\Admin;

use PDO;

class Product extends \Core\Model{

    public $errArray = [];
    
    function prepareProductData($postData)  
    {
        $productData = [];
        foreach($postData as $key => $value){
            switch($key){
                case 'name':
                    $productData['product_name'] = $value;
                break;
                case 'sku':
                    $productData['sku'] = $value;
                break;
                case 'urlKey':
                    $productData['url_key'] = $value;
                break;
                case 'status':
                    $productData['status'] = $value;
                break;
                case 'description':
                    $productData['description'] = $value;
                break;
                case 'shortDescription':
                    $productData['short_description'] = $value;
                break;
                case 'price':
                    $productData['price'] = $value;
                break;
                case 'stock':
                    $productData['stock'] = $value;
                break;
                case 'stock':
                    $productData['stock'] = $value;
                break; 
                      
            }
        }
        $productData['image'] = $_FILES['products']['name']['image'];
        print_r($productData);
        return $productData;
    }

    public function validate($fieldData)
    {

        foreach($fieldData as $key => $value){
            switch($key){
                case  'urlKey':
                    if(!empty($value) && !ctype_alpha($value)){
                        $this->errArray[$key] = 'URLKey is must be character';
                    }
                break;
                case 'name':
                case 'description':
                case 'shortDescription':
                case 'sku':
                case 'price':
                case 'stock':
                    if(empty($value)){
                        $this->errArray[$key] = "$key is required";
                    }
                break;
                
            }
        }

        if(($this->checkData('categories','url_key',$fieldData['urlKey']))){
            $this->errArray['urlKey'] = 'URLKey is must be different';
        }

        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }

       
    }

    function fileUpload($section,$field,$location)
    {
        $name =$_FILES[$section]['name'][$field];
        $extension = substr($name, strpos($name, '.') + 1);
        $temp = $_FILES[$section]['tmp_name'][$field];
        if (isset($name)) {
            if (!empty($name)) {
                if ($extension == 'jpg' || $extension == "jpeg" ) {
                    $location .= '/';
                    if (move_uploaded_file($temp, $location . $name)) {
                    } else {
                      
                    }
                } else {
                    $this->errArray['image'] =  "please upload only jpeg file";
                }
            } else {
                $this->errArray['image'] = "please choose a file";
            }
        }

        

        if ($this->errArray == []) {
            return true;
        } else {
            return false;
        }
    }

    function getEditProductData($id){
        $conn = self::getDB();
        $query =
        "SELECT
            p.id,p.product_name,p.sku,p.url_key,p.image,p.status,p.description,p.price,p.stock,
            p.short_description,
            c.category_name,c.parent_category,c.id 'category_id'
        FROM
            products P
        INNER JOIN products_categories PC ON
            P.id = PC.product_id
        LEFT JOIN categories C ON
            C.id = PC.category_id WHERE p.id = $id";
            
        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    
    }

    function getErrors()
    {  
        return $this->errArray;
    }
}
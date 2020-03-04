<?php

namespace Model;

class Product extends \Model\Core\Row
{
    const STATUSON  = 1;
    const STATUSOFF  = 0;
    const STATUSOFFLABEL  = "OFF";
    const STATUSONLABEL  = "ON";

    public function getStatusOption()
    {
        return [self::STATUSOFFLABEL => self::STATUSOFF, self::STATUSONLABEL => self::STATUSON];
    }

    public function __construct()
    {
        $this->setTableName('products');
        $this->setPrimaryKey('id');
        $this->setAdapter();
    }

    public function uploadImage($image)
    {
        if (!array_key_exists('name', $image)) {
            throw new \Exception("Image not set");
        }
        $dirPath =  \Index::getBaseDir("media\catalog\product\\");
        if (move_uploaded_file($image['tmp_name'], $dirPath . $image['name'])) {
            $prductImage = new \Model\Product\Image();
            $prductImage->image_name = $image['name'];
            $prductImage->product_id = $this->id;
            if($prductImage->save()){

            }
        }
    }
}

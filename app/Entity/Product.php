<?php

namespace App\Entity;

class Product
{
    public $id;
    public $title;
    public $color;
    public $width;
    public $height;
    public $depth;
    public $qty;
    public $price;
    public $discount;
    
    public function __construct($id, $title, $color, $width, $height, $depth, $qty, $price, $discount)
    {
        $this->id = $id;
        $this->title = (string)$title;
        $this->color = (string)$color;
        $this->width = (float)$width;
        $this->height = (float)$height;
        $this->depth = (float)$depth;
        $this->qty = (float)$qty;
        $this->price = (float)$price;
        $this->discount = (float)$discount;
    }
    public static function productFromArray(array $array)
    {
        if(count($array) < 9) throw new \LogicException('Не верный формат файла');
        return new self(...$array);
    }
}

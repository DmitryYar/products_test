<?php

namespace App\Services\Product;

use App\Entity\Product;
use App\Services\File\CsvReader;

class ProductCsvRepository implements ProductRepositoryInterface
{
    private $csvReader;
    
    public function __construct()
    {
        $this->csvReader = new CsvReader();
        $r = require_once "config/config.php";
        $this->productsFile = $r['products']['file_path'];
        //$this->productsFile = require_once "config/config.php"['products']['file_path'];
    }

    public function getProducts()
    {
        $products = $this->csvReader->readFile($this->productsFile);
        return $this->productMap($products);
    }

    public function productMap($products)
    {
        $res = [];
        foreach($products as $product)
        {
            $res[] = Product::productFromArray($product);
        }
        return $res;
    }


    
}

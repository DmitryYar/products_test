<?php

namespace App\Services\Product;

use App\Entity\ProductsStatistic;

class ProductService
{
    private $productRepository;
    public function __construct()
    {
        $this->productRepository = new ProductCsvRepository();
    }

    public function getProducts()
    {
        return $this->productRepository->getProducts();
    }
    
    public function filterProducts($products, $filter)
    {
        if($filter->titleSearch){
            $products = $this->filterProductByTitle($products, $filter->titleSearch);
        }

        if($filter->orderBy)
        {
            $products = $this->sortProducts($products, $filter->orderBy);
        }
        if(!is_null($filter->priceMore))
        {
            $products = $this->filterProductsByPriceMore($products, $filter->priceMore);
        }

        if(!is_null($filter->priceLess))
        {
            $products = $this->filterProductsByPriceLess($products, $filter->priceLess);
        }
       
        return $products;
    }

    

    public function getProductStatistic($products)
    {
        $stat = new ProductsStatistic();
        foreach($products as $product)
        {
            $stat->calc($product->price, $product->qty, $product->discount);
        }
        return $stat;
    }

    public function filterProductsByPriceLess(array $products, float $priceLess)
    {
        return \array_filter($products, function($item) use ($priceLess){ 
            return $item->price <= $priceLess;
        });
    }

    public function filterProductsByPriceMore(array $products, float $priceMore)
    {
        return \array_filter($products, function($item) use ($priceMore){ 
            return ($item->price >= $priceMore);
        });
    }

    public function filterProductByTitle(array $products, string $query)
    {
        \var_dump($query);
        return \array_filter($products, function($item) use ($query){ 
            return \mb_strpos(\mb_strtolower($item->title), $query) !== false;
        });
    }

    public function sortProducts($products, $orderBy)
    {
        if($orderBy === 'order_by_price_asc') $this->sortByPriceAsc($products);
        if($orderBy === 'order_by_price_desc') $this->sortByPriceDesc($products);
        if($orderBy === 'order_by_discount_desc') $this->sortByDiscountDesc($products);
        if($orderBy === 'order_by_discount_asc') $this->sortByDiscountAsc($products);
        return $products;
    }

    public function sortByPriceAsc($products)
    {
        usort($products, function($a, $b)
        {
            if ($a->price == $b->price) {
                return 0;
            }
            return ($a->price < $b->price) ? -1 : 1;
        });
        //\var_dump($products);
        return $products;
    }

    public function sortByPriceDesc($products)
    {
        usort($products, function($a, $b)
        {
            if ($a->price == $b->price) {
                return 0;
            }
            return ($a->price < $b->price) ? 1 : -1;
        });
        return $products;
    }

    public function sortByDiscountAsc($products)
    {
        usort($products, function($a, $b)
        {
            if ($a->discount == $b->discount) {
                return 0;
            }
            return ($a->discount < $b->discount) ? -1 : 1;
        });
        return $products;
    }

    public function sortByDiscountDesc($products)
    {
        usort($products, function($a, $b)
        {
            if ($a->discount == $b->discount) {
                return 0;
            }
            return ($a->discount < $b->discount) ? 1 : -1;
        });
        return $products;
    }
}

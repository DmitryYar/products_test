<?php

namespace App\Services\Product;

class ProductFilter
{
    public $orderBy = null;
    public $paginateBy = 10;
    public $titleSearch = null;
    public $priceMore = null;
    public $priceLess = null;
    public $page = null;

    public function __construct(array $data)
    {
        if(isset($data['order_by']) && $data['order_by'] !== "") $this->orderBy = $data['order_by'];
        if(isset($data['paginate_by']) && $data['paginate_by'] !== "") $this->paginateBy = (int)$data['paginate_by'];
        if(isset($data['title_search']) && $data['title_search']!== "") $this->titleSearch = mb_strtolower($data['title_search']);
        if(isset($data['price_more']) && $data['price_more'] !== "") $this->priceMore = (float)$data['price_more'];
        if(isset($data['price_less']) && $data['price_less'] !== "") $this->priceLess = (float)$data['price_less'];
        if(isset($data['page']) && $data['page'] !== "") $this->page = (int)$data['page'];
    }
}

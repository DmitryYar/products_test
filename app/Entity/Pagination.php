<?php

namespace App\Entity;

class Pagination
{
    public $page = 1;
    public $paginateBy = 10;
    public $pageLinks = [];
    public $totalItems;
    private $products;

    public function __construct($products, $filter)
    {
        if ($filter->page !== null) $this->page = $filter->page;
        $this->products = $products;
        $this->totalItems = count($products);
        $this->paginateBy = $filter->paginateBy;
        if ($filter->paginateBy < 1) throw new \LogicException('Ошибка во введенном запросе');
        $this->totalPages = ceil($this->totalItems / $this->paginateBy);
    }

    public function paginate() {

        return array_slice(
            $this->products,
            ($this->page - 1) * $this->paginateBy,
            $this->paginateBy,
        );
    }

    public function hasPages()
    {
        return $this->totalItems > $this->paginateBy;
    }

    public function links()
    {
        $links = [];
        if ($this->hasPages()) {
            for ($i = 1; $i <= $this->totalPages; $i++) {
                $links[] = ['number' => $i, 'isActive' => $i === $this->page, 'link' => htmlspecialchars($_SERVER['PHP_SELF']) . '?'. http_build_query(array_merge($_GET, ["page"=> $i]))];
            }
        }
        return $links;
    }
}

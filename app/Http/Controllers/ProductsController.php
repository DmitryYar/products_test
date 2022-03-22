<?php

namespace App\Http\Controllers;

use App\Entity\Pagination;
use App\Services\Product\ProductFilter;
use App\Services\Product\ProductService;
use LogicException;

class ProductsController extends Controller
{
    private $productService;
    
    public function __construct()
    {
        parent::__construct();
        $this->productService = new ProductService();
    }
    
    public function index()
    {
        try{
            $filter = new ProductFilter($_GET);
            $products = $this->productService->getProducts();
            $productStatistics = $this->productService->getProductStatistic($products);
            $products = $this->productService->filterProducts($products, $filter);
            $paginator = new Pagination($products, $filter);
            $products = $paginator->paginate();
        } catch(LogicException $e) {
            return $this->twig->render('error.html', ['error' => $e->getMessage()]);    
        }
        
        return $this->twig->render('products.html', ['products' => $products, 'statistics' => $productStatistics, 'filter' => $filter, 'paginator' => $paginator->links()]);
    }
}

<?php

use App\Http\Controllers\ProductsController;

    chdir(dirname(__DIR__));
    require_once "vendor/autoload.php";
    
    //Тут можно сделать роутинг, но в данной задаче не требуется
    $controller = new ProductsController();
    echo $controller->index();
?>

<?php

namespace App\Http\Controllers;

require_once "vendor/autoload.php";


class Controller
{
    protected $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('resources/templates');
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => '/storage/cache/twig',
            'debug' => false,
        ]);
    }
}

<?php

namespace Controllers;
use Lib\Pages;
use Controllers\ProductoController;

class InicioController{
    
    private Pages $pages;
    private ProductoController $productoController;
    
    function __construct(){

        $this->pages = new Pages();
        $this->productoController = new ProductoController();
    }

    public function index(): void{
        $productos = $this->productoController->getRandom();
        $this->pages->render('inicio/index', ['productos' => $productos]);

    }
}
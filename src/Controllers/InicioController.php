<?php

namespace Controllers;
use Lib\Pages;
use Controllers\ProductoController;

class InicioController{
    
    private Pages $pages;
    
    function __construct(){

        $this->pages = new Pages();
    }

    public function index(): void{
        $this->pages->render('inicio/index');

    }
}
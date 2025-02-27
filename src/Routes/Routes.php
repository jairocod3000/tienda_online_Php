<?php
namespace Routes;

use Controllers\InicioController;
use Lib\Router;

class Routes {
    public static function index() {
        Router::añadirRuta('GET', '/', function() {
            return (new InicioController())->index();
        });

    }
}
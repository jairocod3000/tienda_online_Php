<?php
namespace Routes;

use Controllers\InicioController;
use Controllers\CategoriaController;
use Controllers\ProductoController;
use Controllers\UsuarioController;
use Controllers\CarritoController;
use Controllers\ErrorController;
use Controllers\PedidoController;
use Lib\Router;

class Routes {
    public static function index() {
        Router::añadirRuta('GET', '/', function() {
            return (new InicioController())->index();
        });

        Router::añadirRuta('GET', '/categoria/ver/?id=:id', function($id) {
            return (new CategoriaController())->ver($id);
        });

        Router::añadirRuta('GET', '/categoria/crear', function() {
            return (new CategoriaController())->crear();
        });

        Router::añadirRuta('POST', '/categoria/crear', function() {
            return (new CategoriaController())->crear();
        });

        Router::añadirRuta('GET', '/categoria/borrar/?id=:id', function($id) {
            return (new CategoriaController())->borrar($id);
        });

        Router::añadirRuta('GET', '/categoria/editar/?id=:id', function($id) {
            return (new CategoriaController())->editar($id);
        });

        Router::añadirRuta('POST', '/categoria/actualizar', function() {
            return (new CategoriaController())->actualizar();
        });

        Router::añadirRuta('GET', '/categoria/gestionarCategorias', function() {
            return (new CategoriaController())->gestionarCategorias();
        });

        Router::añadirRuta('GET', '/producto/verDetalles/?id=:id', function($id) {
            return (new ProductoController())->verDetalles($id);
        });

        Router::añadirRuta('GET', '/producto/crear', function() {
            return (new ProductoController())->crear();
        });

        Router::añadirRuta('POST', '/producto/crear', function() {
            return (new ProductoController())->crear();
        });

        Router::añadirRuta('GET', '/producto/borrar/?id=:id', function($id) {
            return (new ProductoController())->borrar($id);
        });

        Router::añadirRuta('GET', '/producto/editar/?id=:id', function($id) {
            return (new ProductoController())->editar($id);
        });

        Router::añadirRuta('POST', '/producto/editar', function() {
            return (new ProductoController())->editar();
        });

        Router::añadirRuta('GET', '/producto/gestionarProductos', function() {
            return (new ProductoController())->gestionarProductos();
        });

        Router::añadirRuta('GET', '/carrito/agregarProducto/?id=:id', function($id) {
            return (new CarritoController())->agregarProducto($id);
        });

        Router::añadirRuta('GET', '/carrito/obtenerCarrito', function() {
            return (new CarritoController())->obtenerCarrito();
        });

        Router::añadirRuta('GET', '/carrito/eliminarProducto/?id=:id', function($id) {
            return (new CarritoController())->eliminarProducto($id);
        });

        Router::añadirRuta('GET', '/carrito/aumentarCantidad/?id=:id', function($id) {
            return (new CarritoController())->aumentarCantidad($id);
        });

        Router::añadirRuta('GET', '/carrito/disminuirCantidad/?id=:id', function($id) {
            return (new CarritoController())->disminuirCantidad($id);
        });

        Router::añadirRuta('GET', '/pedido/crear', function() {
            return (new PedidoController())->crear();
        });

        Router::añadirRuta('GET', '/pedido/mostrarPedido', function() {
            return (new PedidoController())->mostrarPedido();
        }); 

        Router::añadirRuta('GET', '/pedido/misPedidos', function() {
            return (new PedidoController())->misPedidos();
        });

        Router::añadirRuta('GET', '/pedido/todosLosPedidos', function() {
            return (new PedidoController())->todosLosPedidos();
        });

        Router::añadirRuta('GET', '/pedido/crear', function() {
            return (new PedidoController())->crear();
        });

        Router::añadirRuta('POST', '/pedido/crear', function() {
            return (new PedidoController())->crear();
        });

        Router::añadirRuta('GET', '/pedido/confirmarPedido/?id=:id', function($id) {
            return (new PedidoController())->confirmarPedido($id);
        });

        Router::añadirRuta('GET', '/pedido/eliminar/?id=:id', function($id) {
            return (new PedidoController())->eliminar($id);
        });

        Router::añadirRuta('GET', '/pedido/editar/?id=:id', function($id) {
            return (new PedidoController())->editar($id);
        });

        Router::añadirRuta('GET', '/pedido/actualizar', function() {
            return (new PedidoController())->actualizar();
        });

        Router::añadirRuta('POST', '/pedido/actualizar', function() {
            return (new PedidoController())->actualizar();
        });

        Router::añadirRuta('GET', '/usuario/login', function() {
            return (new UsuarioController())->login();
        });   

        Router::añadirRuta('POST', '/usuario/login', function() {
            return (new UsuarioController())->login();
        });

        Router::añadirRuta('POST', '/usuario/registro', function() {
            return (new UsuarioController())->registro();
        });

        Router::añadirRuta('GET', '/usuario/registro', function() {
            return (new UsuarioController())->registro();
        });

        Router::añadirRuta('GET', '/usuario/verTodos', function() {
            return (new UsuarioController())->verTodos();
        });

        Router::añadirRuta('GET', '/usuario/logout', function() {
            return (new UsuarioController())->logout();
        });

        Router::añadirRuta('GET', '/usuario/eliminar/?id=:id', function($id) {
            return (new UsuarioController())->eliminar($id);
        });

        Router::añadirRuta('GET', '/usuario/editar/?id=:id', function($id) {
            return (new UsuarioController())->editar($id);
        });

        Router::añadirRuta('GET', '/usuario/editarMiPerfil', function() {
            return (new UsuarioController())->editarMiPerfil();
        });

        Router::añadirRuta('POST', '/usuario/actualizarMiPerfil', function() {
            return (new UsuarioController())->actualizarMiPerfil();
        });

        Router::añadirRuta('POST', '/usuario/actualizar', function() {
            return (new UsuarioController())->actualizar();
        });

        Router::añadirRuta('GET', '/error', function() {
            return (new ErrorController())->error404();
        });

        Router::dispatch();
    }
}
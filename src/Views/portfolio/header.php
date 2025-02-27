<?php
use Controllers\CategoriaController;  

// Instancia del controlador para obtener categorías
$categoriaObj = new CategoriaController();
$categorias = $categoriaObj->obtenerCategorias();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tienda Online</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.7.0/remixicon.css">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/cabecera.css">
</head>
<body>

<header>
    <nav>
        <div class="top-nav">
            <div class="nav-wrapper">
                <div class="brand-logo"></div>

                <ul class="navigation-items" id="category-menu">
                    <li><a href="<?= BASE_URL ?>">Inicio</a></li>
                    <?php foreach ($categorias as $categoria): ?>
                        <li><a href="<?= BASE_URL ?>categoria/ver/?id=<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <div class="user-options">
                    <?php if (!isset($_SESSION['login']) || $_SESSION['login'] == 'failed'): ?>
                        <a href="<?= BASE_URL ?>usuario/login/">Iniciar Sesión</a>
                        <a href="<?= BASE_URL ?>usuario/registro/">Registrarse</a>
                    <?php else: ?>
                        <p><?= $_SESSION['login']->nombre ?> <?= $_SESSION['login']->apellidos ?></p>
                        <a href="<?= BASE_URL ?>usuario/logout/">Cerrar Sesión</a>
                        <a href="<?= BASE_URL ?>pedido/misPedidos/">Mis Pedidos</a>
                    <?php endif; ?>
                    <a href="<?= BASE_URL ?>carrito/obtenerCarrito/">
                        <i class="ri-shopping-cart-2-fill"></i>
                        <?= isset($_SESSION['carrito']) ? count($_SESSION['carrito']) : 0 ?>
                    </a>
                    <?php if (isset($_SESSION['login']) && is_object($_SESSION['login']) && $_SESSION['login']->rol == 'admin'): ?>
                        <a href="<?= BASE_URL ?>usuario/verTodos/">Administrar Usuarios</a>
                        <a href="<?= BASE_URL ?>categoria/gestionarCategorias/">Administrar Categorías</a>
                        <a href="<?= BASE_URL ?>producto/gestionarProductos/">Administrar Productos</a>
                        <a href="<?= BASE_URL ?>pedido/todosLosPedidos/">Administrar Pedidos</a>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </nav>
</header>

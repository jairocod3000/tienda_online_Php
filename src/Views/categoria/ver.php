<?php
use Controllers\CategoriaController;
use Controllers\ProductoController;
use Models\Producto;

$categoriaId = $_GET['id'];
$categoriaController = new CategoriaController();
$productoId = $_GET['id'];

if (empty($productos)): ?>
    <p>No existen productos en esta categoría.</p>
<?php else: ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/observarCategoria.css">
</head>
<body>

    <div class="item-listing">
        <?php foreach ($productos as $producto): ?>
            <div class="item">
                <div class="item-image">
                    <a href="<?=BASE_URL?>producto/verDetalles/?id=<?=$producto['id']?>">
                        <img src="<?=BASE_URL?>img/<?=$producto['imagen']?>" alt="Imagen del producto">
                    </a>
                </div>
                <div class="item-details">
                    <h3><?= $producto['nombre'] ?></h3>
                    <div class="item-price">
                        <p>Precio: <strong><?= $producto['precio'] ?>€</strong></p>
                        <a class="add-to-cart-btn" href="<?=BASE_URL?>carrito/agregarProducto/?id=<?=$producto['id']?>">
                            Añadir al Carrito
                            <i class="ri-shopping-cart-line"></i>
                        </a>
                    </div>
                    <?php if (isset($_SESSION['login']) && $_SESSION['login']->rol == 'admin'): ?>
                        <div class="admin-options">
                            <a href="<?=BASE_URL?>producto/borrar/?id=<?=$producto['id']?>">Eliminar</a>
                            <a href="<?=BASE_URL?>producto/editar/?id=<?=$producto['id']?>">Editar</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
<?php endif; ?>

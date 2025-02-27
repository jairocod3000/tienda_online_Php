<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/mirarCesta.css">
</head>
<body>
    <section class="shopping-cart">
        <div class="cart-summary">
            <h1>Tu Cesta</h1>
            <?php if (isset($errores)): ?>
                <div class="error-messages"><?= $errores ?></div>
            <?php endif; ?>

            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Producto</th>

                        <th>Cantidad</th>
                        
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($_SESSION['carrito'])): ?>
                        <tr>
                            <td colspan="3">La cesta está vacía</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($productos as $producto): ?>
                            <tr>
                                <td>
                                    <div class="cart-item">
                                        <img src="<?=BASE_URL?>img/<?=$producto['imagen']?>" alt="">
                                        <div class="item-info">
                                            <p><?= $producto['nombre'] ?></p>
                                            <p><?= $producto['precio'] ?>€</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="item-quantity">
                                        <button class="decrease-qty" onclick="location.href='<?=BASE_URL?>carrito/disminuirCantidad/?id=<?=$producto['id']?>'">-</button>
                                        <span><?= $producto['cantidad'] ?></span>
                                        <button class="increase-qty" onclick="location.href='<?=BASE_URL?>carrito/aumentarCantidad/?id=<?=$producto['id']?>'">+</button>

                                        <a href="<?=BASE_URL?>carrito/eliminarProducto/?id=<?=$producto['id']?>" class="remove-item"><i class="ri-delete-bin-2-line"></i></a>
                                    </div>
                                </td>
                                <td><p><?= $producto['precio'] * $producto['cantidad'] ?>€</p></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="checkout-area">
                <a href="<?=BASE_URL?>pedido/mostrarPedido" class="checkout-btn">Realizar Pedido</a>
                <div class="cart-total">
                    <?php if (!empty($_SESSION['carrito'])): ?>
                        <p>Total: <strong><?=$total?>€</strong></p>
                        <p>Artículos: <?= count($_SESSION['carrito']) ?></p>
                    <?php else: ?>
                        <p>Total: <strong>0€</strong></p>
                        <p>Artículos: 0</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

</body>
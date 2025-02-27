<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/observarDetalles.css">
</head>
<body>
    
    <section class="product-details">
        <div class="product-card">
            <div class="product-image">
                <img src="<?=BASE_URL?>img/<?=$producto['imagen']?>" alt="Imagen de <?=$producto['nombre']?>">
            </div>
            <div class="product-info">
                <h2><?= $producto['nombre'] ?></h2>
                <p><?= $producto['descripcion'] ?></p>
                <div class="product-pricing">
                    <p class="price-tag">Precio: <strong><?=$producto['precio']?>€</strong></p>
                    <a class="cart-add-btn" href="<?=BASE_URL?>carrito/agregarProducto/?id=<?=$producto['id']?>">
                        Añadir al Carrito
                        <i class="ri-shopping-cart-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>
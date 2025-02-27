<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/realizarPedido.css">
</head>
<body>

    <section class="order-main">
        <div class="order-details">
            <h1>Información del Pedido</h1>
            <h3 class="center-text">Completa tus datos para confirmar tu pedido</h3>
            <?php if(!empty($errores)) : ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="<?=BASE_URL?>pedido/crear" method="POST" class="order-form">
                <div class="form-field">
                    <label for="input-provincia">Provincia</label>
                    <input type="text" id="input-provincia" name="provincia" required>
                </div>

                <div class="form-field">
                    <label for="input-localidad">Localidad</label>
                    <input type="text" id="input-localidad" name="localidad" required>
                </div>

                <div class="form-field">
                    <label for="input-direccion">Dirección</label>
                    <input type="text" id="input-direccion" name="direccion" required>
                </div>

                <button type="submit" class="confirm-button">Confirmar Pedido</button>
            </form>
        </div>
    </section>

</body>
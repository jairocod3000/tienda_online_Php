<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/editarProductos.css">
</head>
<body>
    <section class="edit-section">
        <div class="edit-product-form">
            <h1>Editar Producto</h1>
            <form method="POST" action="<?=BASE_URL?>producto/editar">
                <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>">

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($producto['descripcion']) ?>">
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="text" id="precio" name="precio" value="<?= htmlspecialchars($producto['precio']) ?>">
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría ID:</label>
                    <input type="text" id="categoria_id" name="categoria_id" value="<?= htmlspecialchars($producto['categoria_id']) ?>">
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen:</label>
                    <input type="text" id="imagen" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
                </div>

                <div class="form-actions">
                    <input type="submit" value="Actualizar" class="update-button">
                </div>
            </form>
        </div>
    </section>
</body>
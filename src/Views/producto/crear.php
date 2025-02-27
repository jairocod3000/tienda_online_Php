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
            <h1>Crear Producto</h1>
            <form method="POST" action="<?=BASE_URL?>producto/crear">
                <input type="hidden" name="id" required>

                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" id="descripcion" name="descripcion" required>
                </div>

                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" required>
                </div>

                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" id="stock" name="stock" required>
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría:</label>
                    <select id="categoria_id" name="categoria_id" required>
                    <?php 
                        foreach ($categorias as $categoria)
                        {
                            echo '<option value="'.$categoria['id'].'">'.$categoria['nombre'].'</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-actions">
                    <input type="submit" value="Crear" class="update-button">
                </div>
            </form>
        </div>
    </section>
</body>
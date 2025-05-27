<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mi Perfil</title>
    <link rel="icon" href="<?= BASE_URL ?>public/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/editarMiPerfil.css">
</head>
<body>

<section class="edit-profile-section">
    <div class="edit-profile-main">
        <h1>Editar Mi Perfil</h1>

        <?php if (isset($_SESSION['perfil_update']) && $_SESSION['perfil_update'] === "complete"): ?>
            <div class="success-message">¡Perfil actualizado correctamente!</div>
        <?php elseif (isset($_SESSION['perfil_update']) && $_SESSION['perfil_update'] === "failed"): ?>
            <div class="error-message">Hubo un error al actualizar tu perfil. Inténtalo de nuevo.</div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>usuario/actualizarMiPerfil">
            <input type="hidden" name="id" value="<?= $_SESSION['login']->id ?>">

            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="<?= $_SESSION['login']->nombre ?>" required>

            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" value="<?= $_SESSION['login']->apellidos ?>" required>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</section>

</body>
</html>
<?php use Utils\Utils; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/registro.css">
</head>
<body>

    <div class="fondo_crearCuenta">

        <section class="signup-section">
            <h1>Crear Cuenta</h1>
            <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
                <div class="notification success">Tu registro fue exitoso.</div>
            <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
                <div class="notification failure">Error en el registro, intenta nuevamente.</div>
            <?php endif; ?>
            <?php Utils::removeSession('register'); ?>
            <?php if (!empty($errores)): ?>
                <div class="form-errors">
                    <?php foreach ($errores as $error): ?>
                        <p><?= $error ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="registration-form" action="<?= BASE_URL ?>usuario/registro/" method="POST">
                <div class="form-group">
                    <label for="input-name">Nombre</label>
                    <input type="text" name="data[nombre]" id="input-name" required>
                </div>
            
                <div class="form-group">
                    <label for="input-lastname">Apellidos</label>
                    <input type="text" name="data[apellidos]" id="input-lastname" required>
                </div>

                <?php if (isset($_SESSION['login']) && $_SESSION['login']->rol == 'admin'): ?>
                    <div class="form-group">
                        <label for="select-role">Rol</label>
                        <select name="data[rol]" id="select-role">
                            <option value="admin">Administrador</option>
                            <option value="user">Usuario</option>
                        </select>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="input-email">Correo Electrónico</label>
                    <input type="email" name="data[email]" id="input-email" required>
                </div>
                
                <div class="form-group">
                    <label for="input-password">Contraseña</label>
                    <input type="password" name="data[password]" id="input-password" required>
                </div>

                <?php if (!isset($_SESSION['login'])): ?>
                    <p class="login-link">¿Ya estás registrado? <a href="<?= BASE_URL ?>usuario/login">Inicia sesión aquí</a></p>
                <?php endif; ?>

                <button type="submit" class="submit-btn">Registrarse</button>
            </form>
        </section>

    </div>

</body>

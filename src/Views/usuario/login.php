<?php use Utils\Utils; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/login.css">
</head>
<body>

    <div class="fondo_login">
        <section class="authentication-section">
            <h1>Acceso de Usuarios</h1>
            <?php if (isset($_SESSION['login']) && $_SESSION['login'] == 'complete'): ?>
                <div class="notification success">Acceso correcto, bienvenido al sistema.</div>
            <?php elseif (isset($_SESSION['login']) && $_SESSION['login'] == 'failed'): ?>
                <div class="notification error">Error de acceso. Revisa tu correo y contraseña.</div>
                <?php Utils::removeSession('login'); ?>
                <?php if (!empty($errores)): ?>
                    <div class="list-errors">
                        <?php foreach ($errores as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <?php if (!isset($_SESSION['login']) || $_SESSION['login'] == 'failed'): ?>
            <form class="login-form" action="<?= BASE_URL ?>usuario/login/" method="POST">
                <div class="form-field">
                    <label for="user-email">Correo Electrónico</label>
                    <input type="email" name="data[email]" id="user-email" required>
                </div>

                <div class="form-field">
                    <label for="user-password">Contraseña</label>
                    <input type="password" name="data[password]" id="user-password" required>
                </div>

                <label>
                    <input type="checkbox" name="recordar" value="1">
                    Recordar usuario
                </label>

                <div class="account-options">
                    <p>¿Nuevo usuario? <a href="<?= BASE_URL ?>usuario/registro">Crea una cuenta</a></p>
                </div>

                <button type="submit" class="btn-login">Acceder</button>
            </form>
            <?php endif; ?>
        </section>
    </div>

</body>
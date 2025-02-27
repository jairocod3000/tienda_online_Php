<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?=BASE_URL?>public/css/mostrarPedidos.css">
</head>
<body>
    <section class="order-section">
        <h1>Lista de Pedidos</h1>
        <?php if (isset($_SESSION['login']) && count($pedidos) > 0): ?>
        <div class="order-table-container">
            <table class="orders">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Total</th>
                        <th>Fecha Pedido</th>
                        <th>Hora Pedido</th>
                        <th>Estado Pedido</th>
                        <?php if ($_SESSION['login']->rol == 'admin'): ?>
                            <th>Acción</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><a href="<?=BASE_URL?>pedido/detalle/?id=<?=$pedido['id']?>"><?= $pedido['id'] ?></a></td>
                        <td><?= number_format($pedido['coste'], 2) ?>€</td>
                        <td><?= date('d-m-Y', strtotime($pedido['fecha'])) ?></td>
                        <td><?= date('H:i', strtotime($pedido['hora'])) ?></td>
                        <td><?= $pedido['estado'] ?></td>
                        <?php if ($_SESSION['login']->rol == 'admin'): ?>
                        <td><a href="<?=BASE_URL?>pedido/confirmar/?id=<?=$pedido['id']?>" class="confirm-link"><i class="ri-check-line"></i></a></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
            <p class="no-orders">Actualmente no tienes pedidos registrados.</p>
        <?php endif; ?>
    </section>

</body>
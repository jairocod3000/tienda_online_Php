<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido Confirmado</title>
</head>
<body>
    <h1>Pedido en camino</h1>
    <p>Estimado <?php echo htmlspecialchars($nombre); ?>,</p>
    <p>El pedido esta en reparto.</p>
    <ul>
        <li>ID del pedido: <?php echo htmlspecialchars($idPedido); ?></li>
        <li><table>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
            </tr>
        </table></li>
        <li>Fecha del pedido: <?php echo htmlspecialchars($fecha) ." ". htmlspecialchars($hora);  ?></li>
    </ul>
    <p>Saludos cordiales, <?=$nombre?></p>
    <p>Tienda de Jairo/p>
</body>
</html>

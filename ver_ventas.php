<?php

try {
    $pdo = new PDO('sqlite:db/ventas.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM facturas');
    $facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Ventas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Facturas Registradas</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Código del Cliente</th>
                <th>Nombre del Cliente</th>
                <th>Total</th>
                <th>Comentario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($facturas as $factura) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($factura['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($factura['codigo_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($factura['nombre_cliente']); ?></td>
                    <td><?php echo number_format($factura['total'], 2); ?></td>
                    <td><?php echo htmlspecialchars($factura['comentario']); ?></td>
                    <td><a href="imprimir.php?id=<?php echo $factura['id']; ?>">Imprimir</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

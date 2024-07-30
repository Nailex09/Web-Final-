<?php
if (isset($_GET['id'])) {
    try {
        $pdo = new PDO('sqlite:db/ventas.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('SELECT * FROM facturas WHERE id = ?');
        $stmt->execute([$_GET['id']]);
        $factura = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $pdo->prepare('SELECT * FROM articulos WHERE factura_id = ?');
        $stmt->execute([$_GET['id']]);
        $articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    die('ID de factura no proporcionado.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imprimir Factura</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Factura #<?php echo htmlspecialchars($factura['id']); ?></h1>
            <div class="factura-header">
                <p><strong>Fecha:</strong> <?php echo htmlspecialchars($factura['fecha']); ?></p>
                <p><strong>Código del Cliente:</strong> <?php echo htmlspecialchars($factura['codigo_cliente']); ?></p>
                <p><strong>Nombre del Cliente:</strong> <?php echo htmlspecialchars($factura['nombre_cliente']); ?></p>
            </div>
        </header>

        <section class="articulos-section">
            <h2>Artículos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articulos as $articulo) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($articulo['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($articulo['cantidad']); ?></td>
                            <td><?php echo number_format($articulo['precio'], 2); ?></td>
                            <td><?php echo number_format($articulo['total'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <footer>
            <div class="total">
                <h3>Total a Pagar:</h3>
                <p><?php echo number_format($factura['total'], 2); ?></p>
            </div>
            <p><strong>Comentario:</strong> <?php echo htmlspecialchars($factura['comentario']); ?></p>
            <button onclick="window.print()">Imprimir</button>
        </footer>
    </div>
</body>
</html>

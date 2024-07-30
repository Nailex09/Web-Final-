<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO('sqlite:db/ventas.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $fecha = $_POST['fecha'];
        $codigo_cliente = $_POST['codigo_cliente'];
        $nombre_cliente = $_POST['nombre_cliente'];
        $total_pagar = $_POST['total_pagar'];
        $comentario = $_POST['comentario'];

        // Guardar factura
        $stmt = $pdo->prepare('INSERT INTO facturas (fecha, codigo_cliente, nombre_cliente, total, comentario) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$fecha, $codigo_cliente, $nombre_cliente, $total_pagar, $comentario]);

        $factura_id = $pdo->lastInsertId();

        // Guardar artículos
        foreach ($_POST['nombre_articulo'] as $index => $nombre_articulo) {
            $cantidad = $_POST['cantidad'][$index];
            $precio = $_POST['precio'][$index];
            $total = $_POST['total'][$index];

            $stmt = $pdo->prepare('INSERT INTO articulos (factura_id, nombre, cantidad, precio, total) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$factura_id, $nombre_articulo, $cantidad, $precio, $total]);
        }

        header('Location: ver_ventas.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    die('Método de solicitud no válido.');
}
?>

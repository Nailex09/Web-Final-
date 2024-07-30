<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Ventas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul>
            <li><a href="ver_ventas.php">Ver Ventas</a></li>
            <li><a href="install.php">Instalar Base de Datos</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Registro de Ventas</h1>
        <form action="registrar.php" method="post" id="formularioFactura">
            
            <div class="form-section">
                <h2>Datos del Cliente</h2>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required><br>

                <label for="codigo_cliente">Código del Cliente:</label>
                <input type="text" id="codigo_cliente" name="codigo_cliente" required><br>

                <label for="nombre_cliente">Nombre del Cliente:</label>
                <input type="text" id="nombre_cliente" name="nombre_cliente" required><br>
            </div>

            <div class="form-section">
                <h2>Artículos</h2>
                <button type="button" id="agregarArticulo">Agregar Artículo</button><br>
                <div id="articulos">
                    <div class="articulo">
                        <label for="nombre_articulo">Nombre:</label>
                        <input type="text" name="nombre_articulo[]" required>
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" name="cantidad[]" required>
                        <label for="precio">Precio:</label>
                        <input type="number" step="0.01" name="precio[]" required>
                        <label for="total">Total:</label>
                        <input type="number" step="0.01" name="total[]" readonly>
                    </div>
                </div>

                <label for="total_pagar">Total a Pagar:</label>
                <input type="number" step="0.01" id="total_pagar" name="total_pagar" readonly><br>
            </div>

            <label for="comentario">Comentario:</label>
            <textarea id="comentario" name="comentario"></textarea><br>

            <div class="form-buttons">
                <button type="submit">Guardar Factura</button>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

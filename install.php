<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        echo "Conectando a la base de datos...<br>";
        $pdo = new PDO('sqlite:db/ventas.db');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Conexión establecida.<br>";

        $sql = "
        CREATE TABLE IF NOT EXISTS clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            codigo_cliente TEXT NOT NULL,
            nombre_cliente TEXT NOT NULL
        );
        CREATE TABLE IF NOT EXISTS facturas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            fecha TEXT NOT NULL,
            codigo_cliente TEXT NOT NULL,
            nombre_cliente TEXT NOT NULL,
            total REAL NOT NULL,
            comentario TEXT
        );
        CREATE TABLE IF NOT EXISTS articulos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            factura_id INTEGER NOT NULL,
            nombre TEXT NOT NULL,
            cantidad INTEGER NOT NULL,
            precio REAL NOT NULL,
            total REAL NOT NULL,
            FOREIGN KEY (factura_id) REFERENCES facturas(id)
        );";

        echo "Ejecutando script SQL...<br>";
        $pdo->exec($sql);
        echo "Script SQL ejecutado.<br>";

        echo "Instalación completada con éxito.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo '<form method="POST">
            <button type="submit">Instalar Base de Datos</button>
          </form>';
}
?>

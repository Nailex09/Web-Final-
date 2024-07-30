<?php

try {
    $pdo = new PDO('sqlite:db/ventas.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $queries = [
        'CREATE TABLE IF NOT EXISTS clientes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            codigo TEXT UNIQUE NOT NULL,
            nombre TEXT NOT NULL
        )',
        'CREATE TABLE IF NOT EXISTS facturas (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            fecha TEXT NOT NULL,
            codigo_cliente TEXT NOT NULL,
            nombre_cliente TEXT NOT NULL,
            total REAL NOT NULL,
            comentario TEXT,
            FOREIGN KEY (codigo_cliente) REFERENCES clientes(codigo)
        )',
        'CREATE TABLE IF NOT EXISTS articulos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            factura_id INTEGER,
            nombre TEXT NOT NULL,
            cantidad INTEGER NOT NULL,
            precio REAL NOT NULL,
            total REAL NOT NULL,
            FOREIGN KEY (factura_id) REFERENCES facturas(id)
        )'
    ];

    foreach ($queries as $query) {
        $pdo->exec($query);
    }

    echo "Base de datos y tablas creadas exitosamente.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

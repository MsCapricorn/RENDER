<?php
// mysqli lanza excepciones desde PHP 8.1; las desactivamos para usar connect_error
mysqli_report(MYSQLI_REPORT_OFF);
require 'conexion.php';

// Lista de tablas de la base de datos
$tablas = [];
$resultado = $conexion->query("SHOW TABLES");
while ($fila = $resultado->fetch_row()) {
    $tablas[] = $fila[0];
}

// Si existe la tabla productos (ver database.sql), mostramos su contenido
$productos = [];
if (in_array('productos', $tablas)) {
    $resultado = $conexion->query("SELECT id, nombre, precio, existencia FROM productos ORDER BY id");
    $productos = $resultado->fetch_all(MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi proyecto en Render</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <header>
        <h1>Mi sitio web en Render</h1>
        <p>PHP en Render &rarr; MySQL en Railway</p>
    </header>

    <main>
        <section class="tarjeta ok">
            <h2>Conexión exitosa</h2>
            <p>
                Servidor MySQL <strong><?= htmlspecialchars($conexion->server_info) ?></strong>,
                base de datos <strong><?= htmlspecialchars(getenv('DB_NAME')) ?></strong>.
            </p>
        </section>

        <section class="tarjeta">
            <h2>Tablas en la base de datos (<?= count($tablas) ?>)</h2>
            <?php if ($tablas): ?>
                <ul>
                    <?php foreach ($tablas as $tabla): ?>
                        <li><?= htmlspecialchars($tabla) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>La base está vacía. Ejecuta <code>database.sql</code> en Railway para crear datos de ejemplo.</p>
            <?php endif; ?>
        </section>

        <?php if ($productos): ?>
            <section class="tarjeta">
                <h2>Productos</h2>
                <table>
                    <thead>
                        <tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Existencia</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $p): ?>
                            <tr>
                                <td><?= (int) $p['id'] ?></td>
                                <td><?= htmlspecialchars($p['nombre']) ?></td>
                                <td>$<?= number_format($p['precio'], 2) ?></td>
                                <td><?= (int) $p['existencia'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
    </main>

    <footer>Programación Web Orientada a Servicios</footer>
</body>
</html>
<?php $conexion->close(); ?>

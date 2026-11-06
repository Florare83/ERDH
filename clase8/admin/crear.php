<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/_funciones_juegos.php';

$titulo_pagina = 'Administración — Nuevo juego';
$pagina_actual = 'admin';
$ruta_base     = '../';

$juego = [
    'titulo' => '', 'id_editorial' => 0, 'id_categoria' => 0,
    'jugadores_min' => 2, 'jugadores_max' => 4, 'duracion_min' => 30, 'duracion_max' => 60,
    'edad_minima' => 8, 'precio' => 0, 'stock' => 0,
    'disponible_venta' => 1, 'disponible_prestamo' => 1, 'imagen' => '',
];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $juego   = datosJuegoDesdePost();
    $errores = validarJuego($juego);

    if (!$errores) {
        $sql = "INSERT INTO juegos
                    (titulo, id_editorial, id_categoria, jugadores_min, jugadores_max,
                     duracion_min, duracion_max, edad_minima, precio, stock,
                     disponible_venta, disponible_prestamo, imagen)
                VALUES
                    (:titulo, :id_editorial, :id_categoria, :jugadores_min, :jugadores_max,
                     :duracion_min, :duracion_max, :edad_minima, :precio, :stock,
                     :disponible_venta, :disponible_prestamo, :imagen)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':titulo'              => $juego['titulo'],
                ':id_editorial'        => $juego['id_editorial'],
                ':id_categoria'        => $juego['id_categoria'],
                ':jugadores_min'       => $juego['jugadores_min'],
                ':jugadores_max'       => $juego['jugadores_max'],
                ':duracion_min'        => $juego['duracion_min'],
                ':duracion_max'        => $juego['duracion_max'],
                ':edad_minima'         => $juego['edad_minima'],
                ':precio'              => $juego['precio'],
                ':stock'               => $juego['stock'],
                ':disponible_venta'    => $juego['disponible_venta'],
                ':disponible_prestamo' => $juego['disponible_prestamo'],
                ':imagen'              => $juego['imagen'] !== '' ? $juego['imagen'] : null,
            ]);
            header('Location: index.php?status=created');
            exit;
        } catch (PDOException $ex) {
            $errores[] = 'No se pudo guardar el juego. Revisá los datos e intentá de nuevo.';
        }
    }
}

$stmt = $pdo->prepare('SELECT id_editorial, nombre FROM editoriales ORDER BY nombre');
$stmt->execute();
$editoriales = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT id_categoria, nombre FROM categorias ORDER BY id_categoria');
$stmt->execute();
$categorias = $stmt->fetchAll();

$accion     = 'crear.php';
$textoBoton = 'Guardar juego';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-4">Nuevo juego</h1>
    <?php require __DIR__ . '/_form.php'; ?>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
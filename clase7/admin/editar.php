<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/_funciones_juegos.php';

$titulo_pagina = 'Administración — Editar juego';
$pagina_actual = 'admin';
$ruta_base     = '../';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php?status=invalid');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM juegos WHERE id_juego = :id');
$stmt->execute([':id' => $id]);
$juego = $stmt->fetch();
if (!$juego) {
    header('Location: index.php?status=notfound');
    exit;
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $juego   = datosJuegoDesdePost();
    $errores = validarJuego($juego);

    if (!$errores) {
        $sql = "UPDATE juegos SET
                    titulo = :titulo, id_editorial = :id_editorial, id_categoria = :id_categoria,
                    jugadores_min = :jugadores_min, jugadores_max = :jugadores_max,
                    duracion_min = :duracion_min, duracion_max = :duracion_max,
                    edad_minima = :edad_minima, precio = :precio, stock = :stock,
                    disponible_venta = :disponible_venta,
                    disponible_prestamo = :disponible_prestamo, imagen = :imagen
                WHERE id_juego = :id";
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
                ':id'                  => $id,
            ]);
            header('Location: index.php?status=updated');
            exit;
        } catch (PDOException $ex) {
            $errores[] = 'No se pudo actualizar el juego. Revisá los datos e intentá de nuevo.';
        }
    }
}

$stmt = $pdo->prepare('SELECT id_editorial, nombre FROM editoriales ORDER BY nombre');
$stmt->execute();
$editoriales = $stmt->fetchAll();

$stmt = $pdo->prepare('SELECT id_categoria, nombre FROM categorias ORDER BY id_categoria');
$stmt->execute();
$categorias = $stmt->fetchAll();

$accion     = 'editar.php?id=' . $id;
$textoBoton = 'Guardar cambios';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-4">Editar juego #<?= (int) $id ?></h1>
    <?php require __DIR__ . '/_form.php'; ?>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
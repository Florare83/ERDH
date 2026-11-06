<?php
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';

$titulo_pagina = 'Administración — Juegos';
$pagina_actual = 'admin';
$ruta_base     = '../';

$mensajes = [
    'created'  => ['success', 'Juego creado correctamente.'],
    'updated'  => ['success', 'Juego actualizado correctamente.'],
    'deleted'  => ['success', 'Juego eliminado correctamente.'],
    'notfound' => ['warning', 'El juego solicitado no existe.'],
    'invalid'  => ['warning', 'Solicitud inválida.'],
    'fk'       => ['danger',  'No se puede eliminar: el juego tiene préstamos asociados.'],
    'error'    => ['danger',  'Ocurrió un error al procesar la operación.'],
];
$mensaje = $mensajes[$_GET['status'] ?? ''] ?? null;

$sql = "SELECT j.id_juego, j.titulo, e.nombre AS editorial, c.nombre AS categoria,
               j.precio, j.stock
        FROM juegos j
        INNER JOIN editoriales e ON e.id_editorial = j.id_editorial
        INNER JOIN categorias  c ON c.id_categoria = j.id_categoria
        ORDER BY j.id_juego DESC";
$stmt = $pdo->prepare($sql);   // preparada incluso sin parámetros
$stmt->execute();
$juegos = $stmt->fetchAll();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-4">Administración de juegos</h1>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?= $mensaje[0] ?>" role="alert"><?= e($mensaje[1]) ?></div>
    <?php endif; ?>

    <a href="crear.php" class="btn btn-primary mb-3">Agregar juego</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th><th>Título</th><th>Editorial</th><th>Categoría</th>
                    <th>Precio</th><th>Stock</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($juegos as $j): ?>
                <tr>
                    <td><?= e($j['id_juego']) ?></td>
                    <td><?= e($j['titulo']) ?></td>
                    <td><?= e($j['editorial']) ?></td>
                    <td><?= e($j['categoria']) ?></td>
                    <td>$<?= e(number_format($j['precio'], 2, ',', '.')) ?></td>
                    <td><?= e($j['stock']) ?></td>
                    <td class="text-nowrap">
                        <a href="editar.php?id=<?= (int) $j['id_juego'] ?>"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="eliminar.php" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Confirma eliminar este juego?')">
                            <input type="hidden" name="id" value="<?= (int) $j['id_juego'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (!$juegos): ?>
                <tr><td colspan="7" class="text-center">No hay juegos cargados.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
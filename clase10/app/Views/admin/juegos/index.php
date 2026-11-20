<main class="container py-5">
    <h1 class="h3 mb-4">Administración de juegos</h1>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?= $mensaje[0] ?>" role="alert"><?= e($mensaje[1]) ?></div>
    <?php endif; ?>

    <a href="index.php?accion=crear" class="btn btn-primary mb-3">Agregar juego</a>

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
                        <a href="index.php?accion=editar&id=<?= (int) $j['id_juego'] ?>"
                           class="btn btn-sm btn-warning">Editar</a>
                        <form action="index.php?accion=eliminar" method="POST" class="d-inline"
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
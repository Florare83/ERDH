
<main class="container py-5 admin-juegos">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <span class="text-uppercase small fw-bold text-secondary">
                El Rincón de Hermes
            </span>
            <h1 class="h3 fw-bold mb-1">Administración de juegos</h1>
            <p class="text-muted mb-0">
                Gestioná el catálogo, los precios y el stock de juegos.
            </p>
        </div>

        <a href="index.php?accion=crear" class="btn btn-primary px-4 py-2">
            <span class="me-1">＋</span> Agregar juego
        </a>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?= e($mensaje[0]) ?> alert-dismissible fade show"
             role="alert">
            <?= e($mensaje[1]) ?>
            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white border-0 px-4 py-3">
            <h2 class="h6 fw-bold mb-0">Listado de juegos</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Título</th>
                        <th>Editorial</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-end pe-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($juegos as $j): ?>
                    <tr>
                        <td class="ps-4 text-muted">
                            #<?= e($j['id_juego']) ?>
                        </td>
                        <td class="fw-semibold">
                            <?= e($j['titulo']) ?>
                        </td>
                        <td><?= e($j['editorial']) ?></td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border">
                                <?= e($j['categoria']) ?>
                            </span>
                        </td>
                        <td class="fw-semibold">
                            $<?= e(number_format($j['precio'], 2, ',', '.')) ?>
                        </td>
                        <td>
                            <?php if ((int)$j['stock'] > 0): ?>
                                <span class="badge bg-success-subtle text-success">
                                    <?= e($j['stock']) ?> disponibles
                                </span>
                            <?php else: ?>
                                <span class="badge bg-danger-subtle text-danger">
                                    Sin stock
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4 text-nowrap">
                            <a href="index.php?accion=editar&id=<?= (int) $j['id_juego'] ?>"
                               class="btn btn-sm btn-outline-primary">
                                Editar
                            </a>

                            <form action="index.php?accion=eliminar"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('¿Confirma eliminar este juego?')">
                                <input type="hidden" name="id"
                                       value="<?= (int) $j['id_juego'] ?>">
                                <button type="submit"
                                        class="btn btn-sm btn-outline-danger">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <?php if (!$juegos): ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            Todavía no hay juegos cargados en el catálogo.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php
// Espera: $juego, $errores, $editoriales, $categorias, $accion, $textoBoton
$numericos = [
    'jugadores_min' => 'Jugadores (mín.)', 'jugadores_max' => 'Jugadores (máx.)',
    'duracion_min'  => 'Duración mín. (min)', 'duracion_max' => 'Duración máx. (min)',
    'edad_minima'   => 'Edad mínima', 'precio' => 'Precio', 'stock' => 'Stock',
];
?>
<?php if ($errores): ?>
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0">
            <?php foreach ($errores as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= e($accion) ?>" method="POST" class="row g-3" novalidate>
    <div class="col-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo"
               maxlength="100" value="<?= e($juego['titulo']) ?>" required>
    </div>

    <div class="col-md-6">
        <label for="id_editorial" class="form-label">Editorial</label>
        <select class="form-select" id="id_editorial" name="id_editorial" required>
            <option value="">Seleccioná...</option>
            <?php foreach ($editoriales as $ed): ?>
                <option value="<?= (int) $ed['id_editorial'] ?>"
                    <?= (int) $juego['id_editorial'] === (int) $ed['id_editorial'] ? 'selected' : '' ?>>
                    <?= e($ed['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="col-md-6">
        <label for="id_categoria" class="form-label">Categoría</label>
        <select class="form-select" id="id_categoria" name="id_categoria" required>
            <option value="">Seleccioná...</option>
            <?php foreach ($categorias as $cat): ?>
                <option value="<?= (int) $cat['id_categoria'] ?>"
                    <?= (int) $juego['id_categoria'] === (int) $cat['id_categoria'] ? 'selected' : '' ?>>
                    <?= e($cat['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php foreach ($numericos as $campo => $etiqueta): ?>
        <div class="col-6 col-md-3">
            <label for="<?= $campo ?>" class="form-label"><?= e($etiqueta) ?></label>
            <input type="number" class="form-control" id="<?= $campo ?>" name="<?= $campo ?>"
                   min="0" step="<?= $campo === 'precio' ? '0.01' : '1' ?>"
                   value="<?= e($juego[$campo]) ?>">
        </div>
    <?php endforeach; ?>

    <div class="col-12">
        <label for="imagen" class="form-label">Imagen (ruta, ej: img/catan.webp)</label>
        <input type="text" class="form-control" id="imagen" name="imagen"
               maxlength="150" value="<?= e($juego['imagen'] ?? '') ?>">
    </div>

    <div class="col-12">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="disponible_venta"
                   name="disponible_venta" <?= $juego['disponible_venta'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="disponible_venta">Disponible para venta</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="disponible_prestamo"
                   name="disponible_prestamo" <?= $juego['disponible_prestamo'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="disponible_prestamo">Disponible para préstamo</label>
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary"><?= e($textoBoton) ?></button>
        <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
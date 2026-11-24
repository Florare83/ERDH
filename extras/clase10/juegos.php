
<?php

$titulo_pagina = "El Rincón de Hermes — Catálogo";
$pagina_actual = "juegos.php";

require_once 'config/conexion.php';

// --------------------------------------------------
// PARÁMETROS DE BÚSQUEDA Y FILTROS
// --------------------------------------------------

$busqueda = trim($_GET['q'] ?? '');
$editorialSeleccionada = (int)($_GET['editorial'] ?? 0);
$categoriaSeleccionada = (int)($_GET['categoria'] ?? 0);
$tipo = $_GET['tipo'] ?? 'venta';
$orden = $_GET['orden'] ?? 'alfabetico';

if (!in_array($tipo, ['venta', 'prestamo'], true)) {
    $tipo = 'venta';
}

if (!in_array($orden, ['alfabetico', 'novedades'], true)) {
    $orden = 'alfabetico';
}

// --------------------------------------------------
// OBTENER EDITORIALES
// --------------------------------------------------

$stmtEditoriales = $pdo->query("
    SELECT id_editorial, nombre
    FROM editoriales
    ORDER BY nombre ASC
");

$editoriales = $stmtEditoriales->fetchAll();

// --------------------------------------------------
// OBTENER CATEGORÍAS
// --------------------------------------------------

$stmtCategorias = $pdo->query("
    SELECT id_categoria, nombre
    FROM categorias
    ORDER BY nombre ASC
");

$categorias = $stmtCategorias->fetchAll();

// --------------------------------------------------
// CONSULTA DEL CATÁLOGO
// --------------------------------------------------

$sql = "
    SELECT
        j.*,
        e.nombre AS editorial,
        c.nombre AS categoria
    FROM juegos j
    LEFT JOIN editoriales e
        ON j.id_editorial = e.id_editorial
    LEFT JOIN categorias c
        ON j.id_categoria = c.id_categoria
    WHERE 1 = 1
";

$params = [];

// Disponibilidad según tipo de catálogo
if ($tipo === 'venta') {
    $sql .= " AND j.disponible_venta = 1";
} else {
    $sql .= " AND j.disponible_prestamo = 1";
}

// Filtro por editorial
if ($editorialSeleccionada > 0) {
    $sql .= " AND j.id_editorial = :editorial";
    $params[':editorial'] = $editorialSeleccionada;
}

// Filtro por categoría
if ($categoriaSeleccionada > 0) {
    $sql .= " AND j.id_categoria = :categoria";
    $params[':categoria'] = $categoriaSeleccionada;
}

// Búsqueda por título
if ($busqueda !== '') {
    $sql .= " AND j.titulo LIKE :busqueda";
    $params[':busqueda'] = '%' . $busqueda . '%';
}

// Ordenamiento
if ($orden === 'novedades') {
    $sql .= " ORDER BY j.created_at DESC";
} else {
    $sql .= " ORDER BY j.titulo ASC";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$juegos = $stmt->fetchAll();

// --------------------------------------------------
// CABECERA Y NAVEGACIÓN
// --------------------------------------------------

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

<main class="container py-5 catalogo-hermes">

    <!-- PRESENTACIÓN -->

    <section class="text-center mb-5">

        <span class="text-uppercase fw-bold small text-secondary">
            El Rincón de Hermes
        </span>

        <h1 class="display-5 fw-bold mt-2">
            Nuestro catálogo
        </h1>

        <p class="text-muted">
            Descubrí juegos, compartí experiencias y encontrá tu próxima aventura.
        </p>

    </section>

    <!-- TIPO DE CATÁLOGO -->

    <div class="d-flex justify-content-center flex-wrap gap-3 mb-5">

        <a
            href="juegos.php?tipo=venta"
            class="btn <?= $tipo === 'venta' ? 'btn-primary' : 'btn-outline-primary' ?>"
        >
            Juegos a la venta
        </a>

        <a
            href="juegos.php?tipo=prestamo"
            class="btn <?= $tipo === 'prestamo' ? 'btn-primary' : 'btn-outline-primary' ?>"
        >
            Juegos en préstamo
        </a>

    </div>

    <div class="row g-4">

        <!-- =====================================
             FILTROS
        ====================================== -->

        <aside class="col-12 col-lg-3">

            <div class="card border-0 shadow-sm rounded-4 p-3">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h2 class="h5 fw-bold mb-0">
                        Filtrar juegos
                    </h2>

                    <a
                        href="juegos.php?tipo=<?= htmlspecialchars($tipo) ?>"
                        class="small text-decoration-none"
                    >
                        Limpiar
                    </a>

                </div>

                <form action="juegos.php" method="GET">

                    <input
                        type="hidden"
                        name="tipo"
                        value="<?= htmlspecialchars($tipo) ?>"
                    >

                    <!-- BÚSQUEDA -->

                    <div class="mb-3">

                        <label for="busqueda" class="form-label fw-semibold">
                            Buscar por nombre
                        </label>

                        <input
                            type="search"
                            class="form-control"
                            id="busqueda"
                            name="q"
                            value="<?= htmlspecialchars($busqueda) ?>"
                            placeholder="Ej. Catan"
                            maxlength="100"
                        >

                    </div>

                    <!-- EDITORIALES -->

                    <div class="mb-3">

                        <label for="editorial" class="form-label fw-semibold">
                            Editorial
                        </label>

                        <select
                            class="form-select"
                            id="editorial"
                            name="editorial"
                        >

                            <option value="0">
                                Todas las editoriales
                            </option>

                            <?php foreach ($editoriales as $editorial): ?>

                                <option
                                    value="<?= (int)$editorial['id_editorial'] ?>"
                                    <?= $editorialSeleccionada === (int)$editorial['id_editorial'] ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($editorial['nombre']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- CATEGORÍAS -->

                    <div class="mb-3">

                        <label for="categoria" class="form-label fw-semibold">
                            Categoría
                        </label>

                        <select
                            class="form-select"
                            id="categoria"
                            name="categoria"
                        >

                            <option value="0">
                                Todas las categorías
                            </option>

                            <?php foreach ($categorias as $categoria): ?>

                                <option
                                    value="<?= (int)$categoria['id_categoria'] ?>"
                                    <?= $categoriaSeleccionada === (int)$categoria['id_categoria'] ? 'selected' : '' ?>
                                >
                                    <?= htmlspecialchars($categoria['nombre']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <!-- ORDENAMIENTO -->

                    <div class="mb-3">

                        <label for="orden" class="form-label fw-semibold">
                            Ordenar por
                        </label>

                        <select
                            class="form-select"
                            id="orden"
                            name="orden"
                        >

                            <option
                                value="alfabetico"
                                <?= $orden === 'alfabetico' ? 'selected' : '' ?>
                            >
                                Nombre: A-Z
                            </option>

                            <option
                                value="novedades"
                                <?= $orden === 'novedades' ? 'selected' : '' ?>
                            >
                                Más recientes
                            </option>

                        </select>

                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Aplicar filtros
                    </button>

                </form>

            </div>

        </aside>

        <!-- =====================================
             RESULTADOS DEL CATÁLOGO
        ====================================== -->

        <section class="col-12 col-lg-9">

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">

                <div>

                    <h2 class="h4 fw-bold mb-1">

                        <?= $tipo === 'venta'
                            ? 'Juegos a la venta'
                            : 'Juegos en préstamo' ?>

                    </h2>

                    <span class="text-muted small">

                        <?= count($juegos) ?>

                        <?= count($juegos) === 1
                            ? 'juego encontrado'
                            : 'juegos encontrados' ?>

                    </span>

                </div>

            </div>

            <div class="row g-4">

                <?php foreach ($juegos as $juego): ?>

                    <div class="col-12 col-sm-6 col-xl-4">

                        <article class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">

                            <!-- IMAGEN -->

                            <?php if (!empty($juego['imagen'])): ?>

                                <div
                                    class="juego-imagen d-flex align-items-center justify-content-center"
                                    style="height: 230px; padding: 15px; background: #171025;"
                                >

                                    <img
                                        src="<?= htmlspecialchars($juego['imagen']) ?>"
                                        alt="<?= htmlspecialchars($juego['titulo']) ?>"
                                        style="width: 100%; height: 100%; object-fit: contain;"
                                        loading="lazy"
                                    >

                                </div>

                            <?php else: ?>

                                <div
                                    class="juego-imagen d-flex align-items-center justify-content-center"
                                    style="height: 230px; background: #171025;"
                                >

                                    <span class="text-muted">
                                        Sin imagen disponible
                                    </span>

                                </div>

                            <?php endif; ?>

                            <!-- INFORMACIÓN -->

                            <div class="card-body d-flex flex-column">

                                <span class="small text-muted mb-1">
                                    <?= htmlspecialchars($juego['editorial'] ?? 'Sin editorial') ?>
                                </span>

                                <h3 class="h5 fw-bold mb-2">
                                    <?= htmlspecialchars($juego['titulo']) ?>
                                </h3>

                                <span class="badge bg-light text-dark border align-self-start mb-3">
                                    <?= htmlspecialchars($juego['categoria'] ?? 'Sin categoría') ?>
                                </span>

                                <!-- CARACTERÍSTICAS -->

                                <div class="small text-muted mb-3">

                                    <div class="mb-1">
                                        👥 <?= (int)$juego['jugadores_min'] ?>
                                        a <?= (int)$juego['jugadores_max'] ?> jugadores
                                    </div>

                                    <div class="mb-1">
                                        ⏱️ <?= (int)$juego['duracion_min'] ?>
                                        a <?= (int)$juego['duracion_max'] ?> minutos
                                    </div>

                                    <div>
                                        🎂 Desde <?= (int)$juego['edad_minima'] ?> años
                                    </div>

                                </div>

                                <!-- PRECIO Y STOCK -->

                                <?php if ($tipo === 'venta'): ?>

                                    <p class="fs-5 fw-bold mb-2">

                                        $<?= number_format(
                                            (float)$juego['precio'],
                                            2,
                                            ',',
                                            '.'
                                        ) ?>

                                    </p>

                                    <p class="small text-muted mb-0">

                                        <?php if ((int)$juego['stock'] > 0): ?>

                                            <?= (int)$juego['stock'] ?>
                                            unidades disponibles

                                        <?php else: ?>

                                            Sin stock disponible

                                        <?php endif; ?>

                                    </p>

                                <?php endif; ?>

                            </div>

                        </article>

                    </div>

                <?php endforeach; ?>

                <!-- SIN RESULTADOS -->

                <?php if (empty($juegos)): ?>

                    <div class="col-12">

                        <div class="text-center py-5">

                            <h3 class="h5 fw-bold">
                                No encontramos juegos
                            </h3>

                            <p class="text-muted">
                                Probá modificar los filtros o realizar otra búsqueda.
                            </p>

                            <a
                                href="juegos.php?tipo=<?= htmlspecialchars($tipo) ?>"
                                class="btn btn-outline-primary"
                            >
                                Ver todos los juegos
                            </a>

                        </div>

                    </div>

                <?php endif; ?>

            </div>

        </section>

    </div>

</main>

<?php require_once 'includes/footer.php'; ?>

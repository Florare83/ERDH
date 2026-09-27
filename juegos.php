<!doctype html>
<?php

$titulo_pagina = "El Rincón de Hermes — Juegos";

$pagina_actual = "juegos.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

<main class="container py-5">
    <div class="row justify-content-center">
        <!-- Definimos la columna centrada (ejemplo: col-md-8) -->
        <div class="col-12 col-md-8 text-center">
            
            <section aria-labelledby="titulo-venta" class="mb-5">
                <h2 id="titulo-venta" class="titulo-listado h4">Juegos a la venta</h2>
                <p class="subtitulo-listado mb-4">
                    Elegí una categoría para ver el catálogo completo.
                </p>
                <!-- justify-content-center para centrar la fila de botones -->
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="tienda-infantil.php" class="btn btn-categoria">Infantil</a>
                    <a href="tienda-familiar.php" class="btn btn-categoria">Familiar</a>
                    <a href="tienda-experto.php" class="btn btn-categoria">Experto</a>
                </div>
            </section>

            <section aria-labelledby="titulo-prestamo">
                <!-- Cambiado el id a 'titulo-prestamo' para no repetir IDs en HTML -->
                <h2 id="titulo-prestamo" class="titulo-listado h4">Juegos en préstamo</h2>
                <p class="subtitulo-listado mb-4">
                    Elegí una categoría para ver el catálogo completo.
                </p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="prestamo-infantil.php" class="btn btn-categoria">Infantil</a>
                    <a href="prestamo-familiar.php" class="btn btn-categoria">Familiar</a>
                    <a href="prestamo-experto.php" class="btn btn-categoria">Experto</a>
                </div>
            </section>

        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

<!doctype html>
<?php

$titulo_pagina = "El Rincón de Hermes — Contacto";

$pagina_actual = "contacto.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-7">
                    <h1 class="titulo-listado h3">Contacto</h1>
                    <p class="subtitulo-listado mb-4">
                        Escribinos tu mensaje y te responderemos lo antes posible.
                    </p>

                    <form class="form-contacto" action="#" method="post" novalidate>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nombre"
                                name="nombre"
                                placeholder="Tu nombre"
                                required
                            />
                        </div>

                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input
                                type="text"
                                class="form-control"
                                id="asunto"
                                name="asunto"
                                placeholder="Asunto del mensaje"
                                required
                            />
                        </div>

                        <div class="mb-4">
                            <label for="mensaje" class="form-label">Mensaje</label>
                            <textarea
                                class="form-control"
                                id="mensaje"
                                name="mensaje"
                                rows="5"
                                placeholder="Escribe tu mensaje"
                                required
                            ></textarea>
                        </div>

                        <button type="submit" class="btn btn-categoria">Enviar</button>
                    </form>
                </div>
            </div>
        </main>

<?php require_once 'includes/footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

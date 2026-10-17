<?php

$titulo_pagina = "El Rincón de Hermes — Nosotros";

$pagina_actual = "index.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

<main class="container py-5">

<h1 class="visually-hidden">
    <?= $nombre_sitio ?> — Quiénes somos y qué ofrecemos
</h1>

    <!-- Bloque: Quiénes somos -->
    <section
        class="row align-items-center mb-5"
        aria-labelledby="titulo-quienes-somos"
    >
        <div class="col-md-8">
            <div class="card-bloque">

                <h2 id="titulo-quienes-somos">
                    Quiénes somos
                </h2>

                <p class="seccion-texto mb-0">
                    Un espacio pensado para jugadores: desde clásicos de mesa hasta
                    novedades, con un club activo y eventos para compartir.
                </p>

            </div>
        </div>

        <div class="col-md-4 mt-3 mt-md-0">
            <div class="img-placeholder" role="img">

                <img
                    src="img/grupo.jpeg"
                    alt="Equipo del rincón"
                >

            </div>
        </div>
    </section>

    <!-- Bloque: Qué ofrecemos -->
    <section
        class="row align-items-center"
        aria-labelledby="titulo-que-ofrecemos"
    >
        <div class="col-md-8 order-md-1 order-2">
            <div class="card-bloque">

                <h2 id="titulo-que-ofrecemos">
                    Qué ofrecemos
                </h2>

                <p class="seccion-texto mb-0">
                    Un lugar donde comprar, jugar en préstamo y compartir una comunidad que
                    gira alrededor de los juegos de mesa.
                </p>

            </div>
        </div>

        <div class="col-md-4 mt-3 mt-md-0 order-md-2 order-1">
            <div class="img-placeholder" role="img">

                <img
                    src="img/eventos.jpeg"
                    alt="Gente jugando"
                >

            </div>
        </div>
    </section>

</main>

<?php require_once 'includes/footer.php'; ?>
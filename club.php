<!doctype html>
<?php

$titulo_pagina = "El Rincón de Hermes — Club";

$pagina_actual = "club.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

        <main class="container py-5">
            <h1 class="visually-hidden">Club — Cronograma de eventos y juegos en préstamo</h1>

            <!-- Cronograma de eventos -->
            <section class="mb-5" aria-labelledby="titulo-cronograma">
                <h2 id="titulo-cronograma" class="titulo-listado h4">Cronograma de eventos</h2>
                <p class="subtitulo-listado mb-4">
                    Organizá tu semana con nuestras juntadas y torneos.
                </p>

                <div class="evento-item">
                    <div
                        class="img-placeholder"
                        role="img"
                        >
                                                <img 
                            src="img/eventos.jpeg"
                            alt="Gente jugando"
                        >
                    </div>
                    <div>
                        <h3>Tarde de juegos</h3>
                        <p>Una tarde mensual para descubrir juegos de mesa modernos <br>
                        Fecha: Domingo 27 de septiembre <br>
                        Horario: de 17 a 21 <br>
                        Lugar: Fundación Copaipa - Zuviría 291
                        </p>
                    </div>
                </div>

                <div class="evento-item mb-0">
                <div
                        class="img-placeholder"
                        role="img"
                        >
                                                <img 
                            src="img/catan.webp"
                            alt="Juego Catan"
                        >
                    </div>
                    <div>
                        <h3>Torneo de Catán</h3>
                        <p>Torneo abierto a todos los niveles. Inscripción previa por Whatsapp <br>
                        Fecha: Fecha: Domingo 27 de septiembre <br>
                        Horario: de 17 a 21 <br>
                        Lugar: Fundación Copaipa - Zuviría 291
                        </p>
                    </div>
                </div>

               
            </section>

            
        </main>

<?php require_once 'includes/footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

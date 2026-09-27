<!doctype html>
<?php

$titulo_pagina = "El Rincón de Hermes — Préstamo Infantil";

$pagina_actual = "juegos.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

        <main class="container py-5">
            <h1 class="titulo-listado h3">Préstamo</h1>
            <p class="subtitulo-listado mb-4">Infantil</p>

            <nav aria-label="Filtrar por categoría" class="barra-filtros">
                <button type="button" class="btn-filtro" aria-pressed="false">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path d="M4 5h16M7 12h10M10 19h4"></path>
                    </svg>
                    Filtro
                </button>
                <span class="pill-todos">Todos</span>
                <span class="meta-filtro">2-4 jugadores · 15-30 min</span>
            </nav>

            <div class="row g-4" role="list">
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, ilustración colorida"
                        >
                        <img 
                            src="img/el_lavarropas.webp"
                            alt="Juego El Lavarropas"
                        >
                        </div>
                        <div class="game-card-body">
                            <h3>El lavarropas</h3>
                            <p class="editorial">Multiverso</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-4</span></li>
                                <li><span>Duración</span><span>15-30 min</span></li>
                                <li><span>Edad</span><span>6+</span></li>
                            </ul>
                            <p class="game-card-precio">$50.000</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, ilustración colorida"
                        >
                        <img 
                            src="img/flamencos.webp"
                            alt="Juego Flamencos"
                        >
                        </div>
                        <div class="game-card-body">
                            <h3>Flamencos</h3>
                            <p class="editorial">Maldon</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-4</span></li>
                                <li><span>Duración</span><span>15-30 min</span></li>
                                <li><span>Edad</span><span>6+</span></li>
                            </ul>
                            <p class="game-card-precio">$24.000</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, ilustración colorida"
                        >
                                                    <img 
                            src="img/el_tiburon.webp"
                            alt="Juego El Tiburon"
                        >
                                <rect x="3" y="5" width="18" height="14" rx="2"></rect>
                                <circle cx="9" cy="10" r="1.5"></circle>
                                <path d="M3 16l5-4 4 3 3-2 6 5"></path>
                            </svg>
                        </div>
                        <div class="game-card-body">
                            <h3>El Tiburon</h3>
                            <p class="editorial">Maldon</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-4</span></li>
                                <li><span>Duración</span><span>15-30 min</span></li>
                                <li><span>Edad</span><span>6+</span></li>
                            </ul>
                            <p class="game-card-precio">$40.000</p>
                        </div>
                    </article>
                </div>
            </div>
        </main>

<?php require_once 'includes/footer.php'; ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>

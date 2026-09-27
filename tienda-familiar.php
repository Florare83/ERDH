<!doctype html>
<?php

$titulo_pagina = "El Rincón de Hermes — Tienda Familiar";

$pagina_actual = "juegos.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

        <main class="container py-5">
            <h1 class="titulo-listado h3">Tienda</h1>
            <p class="subtitulo-listado mb-4">Familiar</p>

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
                <span class="meta-filtro">2-6 jugadores · 60-120 min</span>
            </nav>

            <div class="row g-4" role="list">
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, tablero de estrategia"
                        >
                        <img 
                            src="img/esquinados.webp"
                            alt="Juego Esquinados"
                        >
                        </div>
                        <div class="game-card-body">
                            <h3>Esquinados</h3>
                            <p class="editorial">Maldon</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-6</span></li>
                                <li><span>Duración</span><span>60-120 min</span></li>
                                <li><span>Edad</span><span>12+</span></li>
                            </ul>
                            <p class="game-card-precio">$60.000</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, tablero de estrategia"
                        >
                        <img 
                            src="img/catan.webp"
                            alt="Juego Catan"
                        >
                        </div>
                        <div class="game-card-body">
                            <h3>Catan</h3>
                            <p class="editorial">Devir</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-6</span></li>
                                <li><span>Duración</span><span>60-120 min</span></li>
                                <li><span>Edad</span><span>12+</span></li>
                            </ul>
                            <p class="game-card-precio">$67.888</p>
                        </div>
                    </article>
                </div>
                <div class="col-md-4" role="listitem">
                    <article class="game-card">
                        <div
                            class="img-placeholder"
                            role="img"
                            aria-label="Portada de juego infantil, tablero de estrategia"
                        >
                        <img 
                            src="img/carcassonne.webp"
                            alt="Juego Carcassonne"
                        >
                        </div>
                        <div class="game-card-body">
                            <h3>Carcassone</h3>
                            <p class="editorial">Devir</p>
                            <ul class="game-card-meta">
                                <li><span>Jugadores</span><span>2-6</span></li>
                                <li><span>Duración</span><span>60-120 min</span></li>
                                <li><span>Edad</span><span>12+</span></li>
                            </ul>
                            <p class="game-card-precio">$70.000</p>
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

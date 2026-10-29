<?php

$titulo_pagina = "El Rincón de Hermes — FAQ";

$pagina_actual = "faq.php";

require_once 'includes/header.php';
require_once 'includes/nav.php';

?>

        <main class="container py-5">
            <div class="d-flex align-items-center gap-3 mb-2 flex-wrap">
                <h1 class="titulo-listado h3 mb-0">Preguntas Frecuentes</h1>

            </div>
            <p class="subtitulo-listado mb-4">
                Preguntas frecuentes
            </p>

            <div class="accordion accordion-erdh" id="acordeonFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq1"
                            aria-expanded="true"
                            aria-controls="faq1"
                        >
                            ¿Cuándo se juntan a jugar juegos de mesa?
                        </button>
                    </h2>
                    <div
                        id="faq1"
                        class="accordion-collapse collapse show"
                        data-bs-parent="#acordeonFAQ"
                    >
                        <div class="accordion-body">
                            Organizamos una juntada mensual que siempre cae un sábado o domingo.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq2"
                            aria-expanded="false"
                            aria-controls="faq2"
                        >
                            ¿Para asistir a los eventos debo pagar algo?
                        </button>
                    </h2>
                    <div
                        id="faq2"
                        class="accordion-collapse collapse"
                        data-bs-parent="#acordeonFAQ"
                    >
                        <div class="accordion-body">
                            Las tardes de juegos no tienen un costo fijo, sólo pedimos una colaboración a voluntad para sostener la movida. La colaboración recomendada es de $1.000 por persona.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq3"
                            aria-expanded="false"
                            aria-controls="faq3"
                        >
                            ¿Puedo pedir préstamos de juegos?
                        </button>
                    </h2>
                    <div
                        id="faq3"
                        class="accordion-collapse collapse"
                        data-bs-parent="#acordeonFAQ"
                    >
                        <div class="accordion-body">
                            Sí, pero cabe aclarar que el préstamo sólo se realiza en los eventos y en el lugar destinado a los mismos, no fuera de ellos.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button
                            class="accordion-button collapsed"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#faq4"
                            aria-expanded="false"
                            aria-controls="faq4"
                        >
                            ¿Cómo reservo una mesa para un evento?
                        </button>
                    </h2>
                    <div
                        id="faq4"
                        class="accordion-collapse collapse"
                        data-bs-parent="#acordeonFAQ"
                    >
                        <div class="accordion-body">
                            En el caso de las tardes de juegos no hay reserva, sólo basta con asistir directamente. En cambio, en el caso de los torneos se solicita inscripción previa.
                        </div>
                    </div>
                </div>
            </div>
        </main>

<?php require_once 'includes/footer.php'; ?>



<?php
$titulo_pagina = 'El Rincón de Hermes — Buscar';
$pagina_actual = 'buscar.php';

require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container py-5">
  <h1>Buscador de juegos</h1>

  <form id="formBusqueda" class="row g-2 mb-4" role="search">
    <div class="col-12 col-md-8">
      <label for="inputBusqueda" class="visually-hidden">Buscar juego</label>
      <input type="search" class="form-control" id="inputBusqueda" name="q"
             placeholder="Buscar un juego..." autocomplete="off" maxlength="50">
    </div>
    <div class="col-12 col-md-4">
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>

  <p id="estadoBusqueda" class="text-muted" role="status" aria-live="polite"></p>

  <div id="resultados" class="row g-4" role="list" data-api="api/buscar_juegos.php"></div>
</main>

<?php require_once 'includes/footer.php'; ?>
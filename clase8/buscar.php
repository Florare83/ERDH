<?php
require_once 'includes/funciones.php';

// Catálogo de ejemplo de juegos de mesa modernos
$items = [
    'Catan',
    'Carcassonne',
    'Ticket to Ride',
    'Pandemic',
    'Dixit',
    'Azul',
    'Wingspan',
    '7 Wonders',
    'Splendor',
    'Terraforming Mars',
    'Gloomhaven',
    'Codenames',
    'Dominion',
    'Agricola',
    'Root'
];

$busqueda = '';
$resultados = [];
$error = '';
$buscado = false;

if (isset($_GET['q'])) {
    $buscado = true;

    // Sanitizar ANTES de procesar o mostrar
    $busqueda = limpiar($_GET['q']);

    // Validar en el servidor
    if (empty($busqueda)) {
        $error = 'Ingresá un término de búsqueda.';
    } elseif (mb_strlen($busqueda) < 2) {
        $error = 'El término debe tener al menos 2 caracteres.';
    } else {
        foreach ($items as $item) {
            if (mb_stripos($item, $busqueda) !== false) {
                $resultados[] = $item;
            }
        }
    }
}

$titulo_pagina = 'El Rincón de Hermes — Buscar';
$pagina_actual = 'buscar.php';

require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container py-5">
  <h1>Buscador de juegos</h1>

  <form action="buscar.php" method="GET" class="row g-2 mb-4" role="search">
    <div class="col-12 col-md-8">
      <label for="q" class="visually-hidden">Buscar juego</label>
      <input type="text" class="form-control" id="q" name="q"
             placeholder="Buscar un juego..." value="<?= $busqueda ?>">
    </div>
    <div class="col-12 col-md-4">
      <button type="submit" class="btn btn-primary w-100">Buscar</button>
    </div>
  </form>

  <?php if ($error): ?>
    <div class="alerta error" role="alert"><p class="mb-0"><?= $error ?></p></div>
  <?php elseif ($buscado): ?>
    <h2>Resultados para "<?= $busqueda ?>"</h2>
    <?php if (empty($resultados)): ?>
      <p>No se encontraron resultados.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($resultados as $r): ?>
          <li><?= $r ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <?php endif; ?>
</main>

<?php require_once 'includes/footer.php'; ?>
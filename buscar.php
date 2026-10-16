<?php
require_once 'includes/funciones.php';

// Datos 
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
    $busqueda = limpiar($_GET['q']);

    if (empty($busqueda)) {
        $error = 'Ingresá un término de búsqueda.';
    } elseif (strlen($busqueda) < 2) {
        $error = 'El término debe tener al menos 2 caracteres.';
    } else {
        foreach ($items as $item) {
            if (stripos($item, $busqueda) !== false) {
                $resultados[] = $item;
            }
        }
    }
}

include 'includes/header.php';
?>

<main>
  <h1>Buscador</h1>

  <form action="buscar.php" method="GET">
    <input type="text" name="q" placeholder="Buscar..." value="<?= $busqueda ?>">
    <button type="submit">Buscar</button>
  </form>

  <?php if ($error): ?>
    <div class="alerta error"><p><?= $error ?></p></div>
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

<?php include 'includes/footer.php'; ?>
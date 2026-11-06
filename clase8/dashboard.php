<?php
require_once __DIR__ . '/includes/sesion.php';
require_once __DIR__ . '/includes/funciones.php';

$titulo_pagina = 'El Rincón de Hermes — Mi panel';
$pagina_actual = 'dashboard.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-3">Hola, <?= e($_SESSION['usuario_nombre'] ?? 'visitante') ?></h1>
    <p>Rol: <strong><?= e($_SESSION['rol'] ?? 'sin sesión') ?></strong></p>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
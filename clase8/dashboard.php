<?php
// VISTA PROTEGIDA 1: cualquier usuario con sesión iniciada puede entrar
$ruta_base = '';
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/includes/funciones.php';

$titulo_pagina = 'El Rincón de Hermes — Mi panel';
$pagina_actual = 'dashboard.php';

$aviso = (($_GET['error'] ?? '') === 'sin_permiso')
    ? 'No tenés permiso para acceder a esa sección.'
    : null;

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-3">Hola, <?= e($_SESSION['usuario_nombre']) ?></h1>

    <?php if ($aviso): ?>
        <div class="alert alert-danger" role="alert"><?= e($aviso) ?></div>
    <?php endif; ?>

    <p>Iniciaste sesión con el rol: <strong><?= e($_SESSION['rol']) ?></strong>.</p>

    <?php if ($_SESSION['rol'] === 'admin'): ?>
        <a href="admin/admin_panel.php" class="btn btn-primary">Ir al panel de administración</a>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
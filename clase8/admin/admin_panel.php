<?php
// VISTA PROTEGIDA 2: solo el rol "admin"
$ruta_base = '../';
require_once __DIR__ . '/../includes/auth_guard.php';
requerir_rol('admin');

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';

$titulo_pagina = 'Administración — Panel';
$pagina_actual = 'admin';

$total_usuarios = (int) $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
$total_juegos   = (int) $pdo->query('SELECT COUNT(*) FROM juegos')->fetchColumn();

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>

<main class="container py-5">
    <h1 class="h3 mb-4">Panel de administración</h1>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card text-center"><div class="card-body">
                <p class="display-6 mb-0"><?= e($total_usuarios) ?></p>
                <p class="text-muted mb-0">Usuarios registrados</p>
            </div></div>
        </div>
        <div class="col-md-6">
            <div class="card text-center"><div class="card-body">
                <p class="display-6 mb-0"><?= e($total_juegos) ?></p>
                <p class="text-muted mb-0">Juegos en catálogo</p>
            </div></div>
        </div>
    </div>

    <a href="index.php" class="btn btn-primary">Administrar juegos</a>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
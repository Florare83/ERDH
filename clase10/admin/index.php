<?php
$ruta_base = '../';
require_once __DIR__ . '/../includes/auth_guard.php';
requerir_rol('admin');
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../includes/funciones.php';
require_once __DIR__ . '/../app/Controllers/JuegoController.php';

$controller = new JuegoController($pdo);

match ($_GET['accion'] ?? 'listar') {
    'crear'    => $controller->crear(),
    'editar'   => $controller->editar(),
    'eliminar' => $controller->eliminar(),
    default    => $controller->index(),
};
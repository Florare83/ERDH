<?php
/**
 * GUARDIÁN DE RUTAS
 *
 * Uso: en la PRIMERA línea de cada página protegida:
 *
 *     $ruta_base = '';    // '' si la página está en clase8/, '../' si está en clase8/admin/
 *     require_once __DIR__ . '/includes/auth_guard.php';
 *
 * Para exigir además un rol específico:
 *
 *     requerir_rol('admin');
 */
require_once __DIR__ . '/sesion.php';

$ruta_base = $ruta_base ?? '';

// 1) Si no hay sesión iniciada, se manda al login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . $ruta_base . 'login.php?error=acceso_denegado');
    exit;
}

// 2) Control por rol: si el usuario no tiene el rol pedido, vuelve al dashboard
function requerir_rol(string $rol): void
{
    global $ruta_base;

    if (($_SESSION['rol'] ?? '') !== $rol) {
        header('Location: ' . $ruta_base . 'dashboard.php?error=sin_permiso');
        exit;
    }
}
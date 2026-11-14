<?php
require_once __DIR__ . '/includes/sesion.php';

// Solo se cierra sesión desde el botón "Salir" (formulario POST).
// Si alguien entra escribiendo la dirección, no pasa nada.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// 1) Vaciar las variables de sesión
session_unset();
$_SESSION = [];

// 2) Borrar la cookie de sesión del navegador
if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(
        session_name(),   // PHPSESSID
        '',               // valor vacío
        time() - 42000,   // fecha en el pasado = el navegador la elimina
        $p['path'],
        $p['domain'],
        $p['secure'],
        $p['httponly']
    );
}

// 3) Destruir la sesión en el servidor
session_destroy();

// 4) Volver al login con un aviso
header('Location: login.php?logout=ok');
exit;
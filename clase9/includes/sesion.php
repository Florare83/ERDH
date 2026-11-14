<?php
/**
 * Inicia la sesión con una cookie segura.
 * Se incluye con require_once en cada página que use sesiones,
 * ANTES de imprimir cualquier HTML.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0,                           // dura hasta cerrar el navegador
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']),   // solo por HTTPS (si el sitio lo usa)
        'httponly' => true,                        // JavaScript no puede leer la cookie
        'samesite' => 'Lax',                       // protege contra ataques CSRF básicos
    ]);
    session_start();
}
<?php
/**
 * Sanitiza un dato recibido desde el navegador ($_POST / $_GET).
 * - trim(): elimina espacios al inicio y al final.
 * - htmlspecialchars(): convierte < > & " ' en entidades HTML para evitar XSS.
 */
function limpiar(string $dato): string
{
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function e($valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}
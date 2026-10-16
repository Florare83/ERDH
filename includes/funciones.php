<?php
function limpiar(string $dato): string {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}
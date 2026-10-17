<?php

$archivo_env = __DIR__ . '/../.env';

if (file_exists($archivo_env)) {
    $lineas = file($archivo_env, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lineas as $linea) {
        $linea = trim($linea);

        // Ignorar comentarios
        if ($linea === '' || str_starts_with($linea, '#')) {
            continue;
        }

        // Separar nombre y valor
        [$clave, $valor] = array_pad(explode('=', $linea, 2), 2, '');

        $clave = trim($clave);
        $valor = trim($valor);

        // Quitar comillas
        $valor = trim($valor, '"\'');

        if ($clave !== '') {
            $_ENV[$clave] = $valor;
        }
    }
}

$nombre_sitio = $_ENV['APP_NAME'] ?? 'El Rincón de Hermes';
$email_contacto = $_ENV['APP_EMAIL'] ?? '';
$entorno = $_ENV['APP_ENV'] ?? 'local';

if ($entorno === 'local') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
}
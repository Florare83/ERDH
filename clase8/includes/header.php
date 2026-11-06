<?php

require_once __DIR__ . '/../config/env.php';

$ruta_base = $ruta_base ?? ''

?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title><?= $titulo_pagina ?></title>

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />

        <!-- Estilos personalizados -->
        <link href="<?= $ruta_base ?>css/estilos.css" rel="stylesheet" />
    </head>

    <body>
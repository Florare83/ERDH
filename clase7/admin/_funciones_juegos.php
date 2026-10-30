<?php
function datosJuegoDesdePost(): array
{
    return [
        'titulo'              => trim($_POST['titulo'] ?? ''),
        'id_editorial'        => (int) ($_POST['id_editorial'] ?? 0),
        'id_categoria'        => (int) ($_POST['id_categoria'] ?? 0),
        'jugadores_min'       => (int) ($_POST['jugadores_min'] ?? 0),
        'jugadores_max'       => (int) ($_POST['jugadores_max'] ?? 0),
        'duracion_min'        => (int) ($_POST['duracion_min'] ?? 0),
        'duracion_max'        => (int) ($_POST['duracion_max'] ?? 0),
        'edad_minima'         => (int) ($_POST['edad_minima'] ?? 0),
        'precio'              => (float) ($_POST['precio'] ?? 0),
        'stock'               => (int) ($_POST['stock'] ?? 0),
        'disponible_venta'    => isset($_POST['disponible_venta']) ? 1 : 0,
        'disponible_prestamo' => isset($_POST['disponible_prestamo']) ? 1 : 0,
        'imagen'              => trim($_POST['imagen'] ?? ''),
    ];
}

function validarJuego(array $d): array
{
    $errores = [];
    if ($d['titulo'] === '')                 $errores[] = 'El título es obligatorio.';
    if (mb_strlen($d['titulo']) > 100)       $errores[] = 'El título no puede superar 100 caracteres.';
    if ($d['id_editorial'] <= 0)             $errores[] = 'Elegí una editorial.';
    if ($d['id_categoria'] <= 0)             $errores[] = 'Elegí una categoría.';
    if ($d['jugadores_min'] < 1 || $d['jugadores_max'] < $d['jugadores_min'])
                                             $errores[] = 'La cantidad de jugadores no es válida.';
    if ($d['duracion_min'] < 1 || $d['duracion_max'] < $d['duracion_min'])
                                             $errores[] = 'La duración no es válida.';
    if ($d['precio'] < 0)                    $errores[] = 'El precio no puede ser negativo.';
    if ($d['stock'] < 0)                     $errores[] = 'El stock no puede ser negativo.';
    return $errores;
}
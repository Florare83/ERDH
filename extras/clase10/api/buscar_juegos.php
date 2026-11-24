
<?php

header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors', '0');

require_once __DIR__ . '/../config/conexion.php';

/**
 * Devuelve una respuesta JSON y finaliza la ejecución.
 */
function responder(int $codigo, array $cuerpo): void
{
    http_response_code($codigo);

    echo json_encode(
        $cuerpo,
        JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE
    );

    exit;
}

// --------------------------------------------------
// 1. Validar método HTTP
// --------------------------------------------------

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');

    responder(405, [
        'status' => 'error',
        'message' => 'Método no permitido.'
    ]);
}

// --------------------------------------------------
// 2. Validar parámetro de búsqueda
// --------------------------------------------------

$q = $_GET['q'] ?? '';

if (!is_string($q)) {
    responder(400, [
        'status' => 'error',
        'message' => 'Parámetro q inválido.'
    ]);
}

$q = trim($q);

if ($q !== '' && mb_strlen($q, 'UTF-8') < 2) {
    responder(400, [
        'status' => 'error',
        'message' => 'La búsqueda debe tener al menos 2 caracteres.'
    ]);
}

if (mb_strlen($q, 'UTF-8') > 50) {
    responder(400, [
        'status' => 'error',
        'message' => 'La búsqueda es demasiado larga.'
    ]);
}

// --------------------------------------------------
// 3. Consultar juegos en la base de datos
// --------------------------------------------------

try {

    $sql = "SELECT
                j.id_juego,
                j.titulo,
                e.nombre AS editorial,
                c.nombre AS categoria,
                j.jugadores_min,
                j.jugadores_max,
                j.duracion_min,
                j.duracion_max,
                j.edad_minima,
                j.precio,
                j.imagen

            FROM juegos j

            INNER JOIN editoriales e
                ON e.id_editorial = j.id_editorial

            INNER JOIN categorias c
                ON c.id_categoria = j.id_categoria";

    // Aplicar búsqueda por título si se ingresó un texto
    if ($q !== '') {
        $sql .= " WHERE j.titulo LIKE :q";
    }

    $sql .= " ORDER BY j.titulo ASC LIMIT 20";

    $stmt = $pdo->prepare($sql);

    if ($q !== '') {
        // Evitar que % y _ funcionen como comodines ingresados por el usuario
        $busqueda = '%' . addcslashes($q, '%_\\');

        $stmt->bindValue(':q', $busqueda, PDO::PARAM_STR);
    }

    $stmt->execute();

    $juegos = $stmt->fetchAll();

    // Convertir el precio decimal a número
    $juegos = array_map(
        function ($juego) {
            $juego['precio'] = (float) $juego['precio'];

            return $juego;
        },
        $juegos
    );

    // --------------------------------------------------
    // 4. Responder correctamente
    // --------------------------------------------------

    responder(200, [
        'status' => 'success',
        'total' => count($juegos),
        'data' => $juegos
    ]);

} catch (PDOException $e) {

    // Guardar el detalle técnico en el registro de errores
    error_log($e->getMessage());

    responder(500, [
        'status' => 'error',
        'message' => 'Error al consultar la base de datos.'
    ]);
}

<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../config/conexion.php';
ini_set('display_errors', '0'); // un warning de PHP mezclado con el JSON lo rompería

function responder(int $codigo, array $cuerpo): void
{
    http_response_code($codigo);
    echo json_encode($cuerpo, JSON_UNESCAPED_UNICODE);
    exit;
}

// 1) Solo aceptamos GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    responder(405, ['status' => 'error', 'message' => 'Método no permitido.']);
}

// 2) Validación del parámetro (nunca confiar en el cliente)
$q = $_GET['q'] ?? '';
if (!is_string($q)) {
    responder(400, ['status' => 'error', 'message' => 'Parámetro q inválido.']);
}
$q = trim($q);
if ($q !== '' && mb_strlen($q) < 2) {
    responder(400, ['status' => 'error', 'message' => 'La búsqueda debe tener al menos 2 caracteres.']);
}
if (mb_strlen($q) > 50) {
    responder(400, ['status' => 'error', 'message' => 'La búsqueda es demasiado larga.']);
}

// 3) Consulta preparada
try {
    $sql = "SELECT j.id_juego, j.titulo, e.nombre AS editorial, c.nombre AS categoria,
                   j.jugadores_min, j.jugadores_max, j.duracion_min, j.duracion_max,
                   j.edad_minima, j.precio, j.imagen
            FROM juegos j
            INNER JOIN editoriales e ON e.id_editorial = j.id_editorial
            INNER JOIN categorias  c ON c.id_categoria = j.id_categoria";

    if ($q !== '') {
        $sql .= " WHERE j.titulo LIKE :q";
    }
    $sql .= " ORDER BY j.titulo LIMIT 20";

    $stmt = $pdo->prepare($sql);
    if ($q !== '') {
        // addcslashes: el usuario no puede usar % o _ como comodines
        $stmt->bindValue(':q', '%' . addcslashes($q, '%_\\') . '%');
    }
    $stmt->execute();

    // DECIMAL llega como string; lo pasamos a número
    $juegos = array_map(
        fn($j) => array_merge($j, ['precio' => (float) $j['precio']]),
        $stmt->fetchAll()
    );

    responder(200, ['status' => 'success', 'total' => count($juegos), 'data' => $juegos]);

} catch (PDOException $e) {
    error_log($e->getMessage());   // el detalle queda en el log, no se le muestra al usuario
    responder(500, ['status' => 'error', 'message' => 'Error al consultar la base de datos.']);
}
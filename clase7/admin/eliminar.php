<?php
require_once __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: index.php?status=invalid');
    exit;
}

try {
    $stmt = $pdo->prepare('DELETE FROM juegos WHERE id_juego = :id');
    $stmt->execute([':id' => $id]);
    $status = $stmt->rowCount() > 0 ? 'deleted' : 'notfound';
} catch (PDOException $ex) {
    // 23000 = violación de clave foránea (el juego tiene préstamos)
    $status = $ex->getCode() === '23000' ? 'fk' : 'error';
}

header('Location: index.php?status=' . $status);
exit;
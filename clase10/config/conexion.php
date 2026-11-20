<?php
require_once __DIR__ . '/env.php';

$host    = $_ENV['DB_HOST'] ?? 'localhost';
$db      = $_ENV['DB_NAME'] ?? 'rincon_de_hermes';
$user    = $_ENV['DB_USER'] ?? 'root';
$pass    = $_ENV['DB_PASS'] ?? '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // El detalle técnico solo se muestra en entorno local
    die($entorno === 'local'
        ? 'Error de conexión: ' . htmlspecialchars($e->getMessage())
        : 'No se pudo conectar a la base de datos.');
}
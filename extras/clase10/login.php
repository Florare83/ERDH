<?php
require_once __DIR__ . '/includes/sesion.php';
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/includes/funciones.php';

// Si ya inició sesión, no tiene sentido mostrar el login
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit;
}

$errores = [];
$email   = '';

// Avisos que llegan por la URL (los vamos a usar en los próximos ejercicios)
$aviso = null;
if (($_GET['error'] ?? '') === 'acceso_denegado') {
    $aviso = ['warning', 'Tenés que iniciar sesión para acceder a esa página.'];
} elseif (($_GET['logout'] ?? '') === 'ok') {
    $aviso = ['info', 'Cerraste sesión correctamente.'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';   // la contraseña no se sanitiza

    if ($email === '' || $password === '') {
        $errores[] = 'Completá el correo y la contraseña.';
    }

    if (!$errores) {
        // Buscar al usuario por email (consulta preparada)
        $stmt = $pdo->prepare(
            'SELECT id, nombre, password, rol FROM usuarios WHERE email = :email'
        );
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        // Si el email no existe, se verifica contra un hash falso para que
        // tarde lo mismo y no se pueda adivinar qué emails están registrados.
        $hash = $usuario['password']
            ?? '$2y$10$1TWyzOLO8iOxud1z1ZgI0OI2HFJKuWwU3cQcBt1R7.HyyD97epg16';

        if ($usuario && password_verify($password, $hash)) {
            // Credenciales correctas
            session_regenerate_id(true);   // evita la fijación de sesión (Session Fixation)

            $_SESSION['usuario_id']     = (int) $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['rol']            = $usuario['rol'];

            header('Location: dashboard.php');
            exit;
        }

        // Mensaje genérico: no revela si falló el email o la contraseña
        $errores[] = 'Correo o contraseña incorrectos.';
    }
}

$titulo_pagina = 'El Rincón de Hermes — Iniciar sesión';
$pagina_actual = 'login.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main class="container py-5" style="max-width: 480px;">
    <h1 class="h3 mb-4">Iniciar sesión</h1>

    <?php if ($aviso): ?>
        <div class="alert alert-<?= e($aviso[0]) ?>" role="alert"><?= e($aviso[1]) ?></div>
    <?php endif; ?>

    <?php if ($errores): ?>
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                <?php foreach ($errores as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" novalidate>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= e($email) ?>" autocomplete="username" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password"
                   autocomplete="current-password" required>
        </div>

        <button type="submit" class="btn btn-primary">Ingresar</button>
        <a href="registro.php" class="btn btn-link">Crear cuenta</a>
    </form>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
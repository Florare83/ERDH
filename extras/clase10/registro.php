<?php
require_once __DIR__ . '/config/conexion.php';
require_once __DIR__ . '/includes/funciones.php';

$errores = [];
$exito   = false;
$nombre  = $email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1) SANITIZAR (anti-XSS)
    // limpiar() = trim() + htmlspecialchars(). Convierte < > & " ' en texto inofensivo.
    $nombre = limpiar($_POST['nombre'] ?? '');

    // El email se limpia con trim y se valida con filter_var más abajo.
    // Un email válido no puede contener < > ni comillas dobles.
    $email = strtolower(trim($_POST['email'] ?? ''));

    // La contraseña NO se pasa por htmlspecialchars: se guardaría distinta de la que escribió la persona.
    $password  = $_POST['password']  ?? '';
    $password2 = $_POST['password2'] ?? '';

    // 2) VALIDAR en el servidor
    if ($nombre === '' || mb_strlen($nombre) > 100) {
        $errores[] = 'El nombre es obligatorio (máximo 100 caracteres).';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 120) {
        $errores[] = 'Ingresá un correo electrónico válido.';
    }

    if (strlen($password) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres.';
    }

    if (strlen($password) > 72) { // bcrypt solo usa los primeros 72 bytes
        $errores[] = 'La contraseña no puede superar los 72 caracteres.';
    }

    if ($password !== $password2) {
        $errores[] = 'Las contraseñas no coinciden.';
    }

    // 3) ¿EL EMAIL YA EXISTE? (consulta preparada)
    if (!$errores) {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $errores[] = 'Ese correo ya está registrado.';
        }
    }

    // 4) GUARDAR con la contraseña encriptada
    if (!$errores) {
        try {
            $hash = password_hash($password, PASSWORD_BCRYPT);

            // No se indica "rol": la tabla le asigna 'usuario' por defecto.
            $stmt = $pdo->prepare(
                'INSERT INTO usuarios (nombre, email, password)
                 VALUES (:nombre, :email, :password)'
            );
            $stmt->execute([
                ':nombre'   => $nombre,
                ':email'    => $email,
                ':password' => $hash,
            ]);

            $exito  = true;
            $nombre = $email = ''; // vaciar el formulario
        } catch (PDOException $ex) {
            // 23000 = email duplicado (por si dos personas se registran a la vez)
            $errores[] = $ex->getCode() === '23000'
                ? 'Ese correo ya está registrado.'
                : 'No se pudo crear la cuenta. Intentá de nuevo más tarde.';
        }
    }
}

$titulo_pagina = 'El Rincón de Hermes — Crear cuenta';
$pagina_actual = 'registro.php';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>

<main class="container py-5" style="max-width: 520px;">
    <h1 class="h3 mb-4">Crear cuenta</h1>

    <?php if ($exito): ?>
        <div class="alert alert-success" role="alert">
            ¡Cuenta creada correctamente! Ya podés iniciar sesión.
        </div>
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

    <form action="registro.php" method="POST" novalidate>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
                   value="<?= e($nombre) ?>" maxlength="100" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email"
                   value="<?= e($email) ?>" maxlength="120" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña (mínimo 8 caracteres)</label>
            <input type="password" class="form-control" id="password" name="password"
                   autocomplete="new-password" required>
        </div>

        <div class="mb-3">
            <label for="password2" class="form-label">Repetir contraseña</label>
            <input type="password" class="form-control" id="password2" name="password2"
                   autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrarme</button>
    </form>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
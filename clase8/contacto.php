<?php
require_once 'includes/funciones.php';

$errores = [];
$exito = false;
$nombre = $email = $mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1) Sanitizar ANTES de procesar o mostrar
    $nombre  = limpiar($_POST['nombre']  ?? '');
    $email   = limpiar($_POST['email']   ?? '');
    $mensaje = limpiar($_POST['mensaje'] ?? '');

    // 2) Validar en el servidor
    if (empty($nombre)) {
        $errores[] = 'El nombre es obligatorio.';
    }

    if (empty($email)) {
        $errores[] = 'El correo es obligatorio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El formato del correo no es válido.';
    }

    if (empty($mensaje)) {
        $errores[] = 'El mensaje es obligatorio.';
    }

    if (empty($errores)) {
        $exito = true;
    }
}

$titulo_pagina = 'El Rincón de Hermes — Contacto';
$pagina_actual = 'contacto.php';

require_once 'includes/header.php';
require_once 'includes/nav.php';
?>

<main class="container py-5">
  <h1>Contacto</h1>
  <p>Escribinos y te respondemos a la brevedad.</p>

  <?php if (!empty($errores)): ?>
    <div class="alerta error" role="alert">
      <p class="mb-1"><strong>Revisá los siguientes errores:</strong></p>
      <ul class="mb-0">
        <?php foreach ($errores as $e): ?>
          <li><?= $e ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ($exito): ?>
    <div class="alerta exito" role="status">
      <p><strong>¡Gracias <?= $nombre ?>! Tu mensaje fue enviado correctamente.</strong></p>
      <p class="mb-1"><strong>Correo:</strong> <?= $email ?></p>
      <p class="mb-0"><strong>Mensaje:</strong> <?= $mensaje ?></p>
    </div>
  <?php endif; ?>

  <form action="contacto.php" method="POST" class="form-contacto" novalidate>
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre"
             value="<?= $exito ? '' : $nombre ?>">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico</label>
      <input type="text" class="form-control" id="email" name="email"
             value="<?= $exito ? '' : $email ?>">
    </div>

    <div class="mb-3">
      <label for="mensaje" class="form-label">Mensaje</label>
      <textarea class="form-control" id="mensaje" name="mensaje" rows="5"><?= $exito ? '' : $mensaje ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Enviar</button>
  </form>
</main>

<?php require_once 'includes/footer.php'; ?>
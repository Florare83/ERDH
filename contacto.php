<?php
require_once 'includes/funciones.php';

$errores = [];
$exito = false;
$nombre = $email = $mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitizar ANTES de procesar
    $nombre  = limpiar($_POST['nombre']  ?? '');
    $email   = limpiar($_POST['email']   ?? '');
    $mensaje = limpiar($_POST['mensaje'] ?? '');

    // Validar en servidor
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
        // Acá podrías guardar en archivo/BD. Para el TP alcanza con mostrar los datos.
    }
}

include 'includes/header.php';
?>

<main>
  <h1>Contacto</h1>

  <?php if (!empty($errores)): ?>
    <div class="alerta error">
      <ul>
        <?php foreach ($errores as $e): ?>
          <li><?= $e ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ($exito): ?>
    <div class="alerta exito">
      <p>¡Gracias <?= $nombre ?>! Tu mensaje fue enviado correctamente.</p>
      <p><strong>Correo:</strong> <?= $email ?></p>
      <p><strong>Mensaje:</strong> <?= $mensaje ?></p>
    </div>
  <?php endif; ?>

  <form action="contacto.php" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" id="nombre" name="nombre" value="<?= $exito ? '' : $nombre ?>">

    <label for="email">Correo electrónico</label>
    <input type="text" id="email" name="email" value="<?= $exito ? '' : $email ?>">

    <label for="mensaje">Mensaje</label>
    <textarea id="mensaje" name="mensaje"><?= $exito ? '' : $mensaje ?></textarea>

    <button type="submit">Enviar</button>
  </form>
</main>

<?php include 'includes/footer.php'; ?>

<?php
$ruta_base = $ruta_base ?? '';
$nombre_sitio = $nombre_sitio ?? 'El Rincón de Hermes';
$email_contacto = $email_contacto ?? '';
?>

<footer class="footer-erdh py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">

        <span>
            &copy; <?= date('Y') ?>
            <?= htmlspecialchars($nombre_sitio) ?>
        </span>

        <?php if (!empty($email_contacto)): ?>
            <a href="mailto:<?= htmlspecialchars($email_contacto) ?>">
                <?= htmlspecialchars($email_contacto) ?>
            </a>
        <?php endif; ?>

    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript personalizado -->
<script src="<?= htmlspecialchars($ruta_base) ?>js/main.js"></script>

</body>
</html>

<footer class="footer-erdh py-4 mt-5">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
        <span>&copy; <?= date('Y') ?> <?= htmlspecialchars($nombre_sitio) ?></span>

        <a href="mailto:<?= htmlspecialchars($email_contacto) ?>">
            <?= htmlspecialchars($email_contacto) ?>
        </a>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="js/main.js"></script>

</body>
</html>
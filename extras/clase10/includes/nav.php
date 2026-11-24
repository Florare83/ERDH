
<?php
$pagina_actual = $pagina_actual ?? basename($_SERVER['PHP_SELF']);
$ruta_base = $ruta_base ?? '';
?>

<header class="controlar-header">
    <nav class="controlar-nav" aria-label="Navegación principal">

        <!-- Marca -->
        <a class="controlar-brand" href="<?= htmlspecialchars($ruta_base) ?>index.php">
            <img src="<?= htmlspecialchars($ruta_base) ?>img/logo.png"
                 alt="El Rincón de Hermes">

            <span>
                <strong>El Rincón de <span>Hermes</span></strong>
                <small>Juegos de Mesa</small>
            </span>
        </a>

        <!-- Menú móvil -->
        <button class="controlar-menu-toggle"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuPrincipal"
                aria-controls="menuPrincipal"
                aria-expanded="false"
                aria-label="Abrir menú">
            ☰
        </button>

        <!-- Enlaces -->
        <div class="collapse navbar-collapse controlar-nav-links"
             id="menuPrincipal">

            <a class="<?= $pagina_actual === 'index.php' ? 'active' : '' ?>"
               href="<?= htmlspecialchars($ruta_base) ?>index.php">
                ⌂ <span>Inicio</span>
            </a>

            <a class="<?= $pagina_actual === 'juegos.php' ? 'active' : '' ?>"
               href="<?= htmlspecialchars($ruta_base) ?>juegos.php">
                Juegos
            </a>

            <a href="<?= htmlspecialchars($ruta_base) ?>index.php#editoriales">
                Editoriales
            </a>

            <a href="<?= htmlspecialchars($ruta_base) ?>juegos.php?orden=novedades">
                Novedades
            </a>

            <a href="<?= htmlspecialchars($ruta_base) ?>juegos.php">
                Ofertas
            </a>

            <a class="<?= $pagina_actual === 'contacto.php' ? 'active' : '' ?>"
               href="<?= htmlspecialchars($ruta_base) ?>contacto.php">
                Contacto
            </a>

            <!-- Buscador -->
            <form class="controlar-search"
                  action="<?= htmlspecialchars($ruta_base) ?>buscar.php"
                  method="GET">

                <button type="submit" aria-label="Buscar">⌕</button>

                <input type="search"
                       name="q"
                       placeholder="Buscar juegos..."
                       aria-label="Buscar juegos">
            </form>

            <!-- Favoritos -->
            <a class="controlar-icon-link"
               href="<?= htmlspecialchars($ruta_base) ?>juegos.php"
               aria-label="Favoritos"
               title="Favoritos">
                ♡
            </a>

            <!-- Carrito -->
            <a class="controlar-icon-link"
               href="<?= htmlspecialchars($ruta_base) ?>juegos.php"
               aria-label="Carrito"
               title="Carrito">
                🛒
            </a>

            <?php if (isset($_SESSION['usuario_id'])): ?>

                <a class="controlar-icon-link"
                   href="<?= htmlspecialchars($ruta_base) ?>dashboard.php"
                   aria-label="Mi cuenta"
                   title="Mi cuenta">
                    ♙
                </a>

                <?php if (($_SESSION['rol'] ?? '') === 'admin'): ?>
                    <a href="<?= htmlspecialchars($ruta_base) ?>admin/index.php">
                        Administración
                    </a>
                <?php endif; ?>

                <form action="<?= htmlspecialchars($ruta_base) ?>logout.php"
                      method="POST">

                    <button class="controlar-login" type="submit">
                        Salir
                    </button>
                </form>

            <?php else: ?>

                <a class="controlar-login"
                   href="<?= htmlspecialchars($ruta_base) ?>login.php">
                    Ingresar
                </a>

            <?php endif; ?>

        </div>
    </nav>
</header>

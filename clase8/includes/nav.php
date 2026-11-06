<?php
$pagina_actual = $pagina_actual ?? basename($_SERVER['PHP_SELF']);
?>

<header>
<nav class="navbar navbar-expand-md navbar-erdh navbar-dark py-3">
    <div class="container">

    <img src="<?= $ruta_base ?>img/logo.png" alt="Logo de <?= htmlspecialchars($nombre_sitio) ?>" />

    <a class="navbar-brand" href="<?= $ruta_base ?>index.php">
        <?= htmlspecialchars($nombre_sitio) ?>
    </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuPrincipal"
            aria-controls="menuPrincipal"
            aria-expanded="false"
            aria-label="Abrir menú de navegación"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse justify-content-end"
            id="menuPrincipal"
        >
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'index.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>index.php"
                    >
                        Nosotros
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'club.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>club.php"
                    >
                        Club
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'juegos.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>juegos.php"
                    >
                        Juegos
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'faq.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>faq.php"
                    >
                        FAQ
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link btn-buscar <?= $pagina_actual === 'buscar.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>buscar.php"
                    >
                        Buscar
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link btn-contacto <?= $pagina_actual === 'contacto.php' ? 'active' : '' ?>"
                        href="<?= $ruta_base ?>contacto.php"
                    >
                        Contacto
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
</header>
<nav class="navbar navbar-expand-md navbar-erdh navbar-dark py-3">
    <div class="container">

        <img src="img/logo.png" alt="Logo de El Rincón de Hermes" />

        <a class="navbar-brand" href="index.php">
            El Rincón de Hermes
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
                        href="index.php"
                    >
                        Nosotros
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'club.php' ? 'active' : '' ?>"
                        href="club.php"
                    >
                        Club
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'juegos.php' ? 'active' : '' ?>"
                        href="juegos.php"
                    >
                        Juegos
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link <?= $pagina_actual === 'faq.php' ? 'active' : '' ?>"
                        href="faq.php"
                    >
                        FAQ
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link btn-contacto <?= $pagina_actual === 'contacto.php' ? 'active' : '' ?>"
                        href="contacto.php"
                    >
                        Contacto
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
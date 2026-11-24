<?php
$titulo_pagina = "ControlAR — Juegos de Mesa";
$pagina_actual = "index.php";

require_once __DIR__ . '/config/conexion.php';
$stmtEditoriales = $pdo->query('SELECT id_editorial, nombre FROM editoriales ORDER BY nombre');
$editoriales = $stmtEditoriales->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$juegosPortada = [
    ['nombre' => 'Catan', 'imagen' => 'catan.webp', 'descripcion' => 'Negociá, construí y expandí tu territorio.'],
    ['nombre' => 'Carcassonne', 'imagen' => 'carcassonne.webp', 'descripcion' => 'Construí paisajes y caminos en cada partida.'],
    ['nombre' => 'Faraway', 'imagen' => 'faraway.webp', 'descripcion' => 'Explorá un mundo lleno de posibilidades.'],
    ['nombre' => 'Ierusalem', 'imagen' => 'ierusalem.webp', 'descripcion' => 'Una experiencia estratégica para compartir.'],
    ['nombre' => 'El Tiburón', 'imagen' => 'el_tiburon.webp', 'descripcion' => 'Una aventura para disfrutar en la mesa.'],
];
?>
<main class="controlar-home">
  <section class="controlar-hero" aria-label="Descubrí juegos de mesa">
    <img src="img/hero-meeples-controlar.jpg" alt="Meeples de colores y dados sobre un tablero de juego" />
  </section>

  <section class="controlar-editoriales" id="editoriales" aria-label="Explorá por editorial">
    <?php if ($editoriales): ?>
      <?php foreach ($editoriales as $editorial): ?>
        <a class="controlar-editorial" href="juegos.php?editorial=<?= (int)$editorial['id_editorial'] ?>">
          <span aria-hidden="true">♟</span>
          <strong><?= htmlspecialchars($editorial['nombre'], ENT_QUOTES, 'UTF-8') ?></strong>
        </a>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="controlar-empty">Todavía no hay editoriales registradas.</p>
    <?php endif; ?>
  </section>

  <section class="controlar-featured" aria-labelledby="controlar-featured-title">
    <div class="controlar-section-title">
      <h2 id="controlar-featured-title"><span aria-hidden="true">🏆</span> Juegos destacados</h2>
      <a href="juegos.php">Ver todos <span aria-hidden="true">→</span></a>
    </div>
    <div class="controlar-products">
      <?php foreach ($juegosPortada as $juego): ?>
        <article class="controlar-product">
          <a class="controlar-product-image" href="juegos.php">
            <img src="img/<?= htmlspecialchars($juego['imagen'], ENT_QUOTES, 'UTF-8') ?>" alt="<?= htmlspecialchars($juego['nombre'], ENT_QUOTES, 'UTF-8') ?>" />
            <span class="controlar-heart" aria-hidden="true">♡</span>
          </a>
          <div class="controlar-product-info">
            <h3><?= htmlspecialchars($juego['nombre'], ENT_QUOTES, 'UTF-8') ?></h3>
            <p><?= htmlspecialchars($juego['descripcion'], ENT_QUOTES, 'UTF-8') ?></p>
            <a class="controlar-add" href="juegos.php">Ver juego <span aria-hidden="true">→</span></a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="controlar-promos" aria-label="Beneficios y comunidad">
    <a class="controlar-promo promo-purple" href="juegos.php">
      <span class="promo-icon" aria-hidden="true">♧</span>
      <span><strong>Envíos a todo el país</strong><small>Comprá desde donde estés</small></span>
      <span class="promo-illustration" aria-hidden="true">🚚</span>
    </a>
    <a class="controlar-promo promo-yellow" href="club.php">
      <span class="promo-icon" aria-hidden="true">★</span>
      <span><strong>Encontrá tus juegos favoritos</strong><small>Y viví grandes momentos</small></span>
      <span class="promo-illustration" aria-hidden="true">♟ ♟</span>
    </a>
  </section>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

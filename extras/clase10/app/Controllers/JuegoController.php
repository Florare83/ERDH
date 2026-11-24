<?php
require_once __DIR__ . '/../Models/Juego.php';

class JuegoController
{
    private Juego $juegos;

    public function __construct(PDO $pdo)
    {
        $this->juegos = new Juego($pdo);
    }

    public function index(): void
    {
        $mensajes = [
            'created'  => ['success', 'Juego creado correctamente.'],
            'updated'  => ['success', 'Juego actualizado correctamente.'],
            'deleted'  => ['success', 'Juego eliminado correctamente.'],
            'notfound' => ['warning', 'El juego solicitado no existe.'],
            'invalid'  => ['warning', 'Solicitud inválida.'],
            'fk'       => ['danger',  'No se puede eliminar: el juego tiene préstamos asociados.'],
            'error'    => ['danger',  'Ocurrió un error al procesar la operación.'],
        ];

        $this->render('index', [
            'titulo_pagina' => 'Administración — Juegos',
            'mensaje'       => $mensajes[$_GET['status'] ?? ''] ?? null,
            'juegos'        => $this->juegos->todos(),
        ]);
    }

    public function crear(): void
    {
        $juego = [
            'titulo' => '', 'id_editorial' => 0, 'id_categoria' => 0,
            'jugadores_min' => 2, 'jugadores_max' => 4, 'duracion_min' => 30, 'duracion_max' => 60,
            'edad_minima' => 8, 'precio' => 0, 'stock' => 0,
            'disponible_venta' => 1, 'disponible_prestamo' => 1, 'imagen' => '',
        ];
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $juego   = $this->datosDesdePost();
            $errores = $this->validar($juego);

            if (!$errores) {
                try {
                    $this->juegos->crear($juego);
                    $this->redirigir('created');
                } catch (PDOException $ex) {
                    $errores[] = 'No se pudo guardar el juego. Revisá los datos e intentá de nuevo.';
                }
            }
        }

        $this->render('crear', [
            'titulo_pagina' => 'Administración — Nuevo juego',
            'juego'         => $juego,
            'errores'       => $errores,
            'editoriales'   => $this->juegos->editoriales(),
            'categorias'    => $this->juegos->categorias(),
            'accion'        => 'index.php?accion=crear',
            'textoBoton'    => 'Guardar juego',
        ]);
    }

    public function editar(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) $this->redirigir('invalid');

        $juego = $this->juegos->buscarPorId($id);
        if (!$juego) $this->redirigir('notfound');

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $juego   = $this->datosDesdePost();
            $errores = $this->validar($juego);

            if (!$errores) {
                try {
                    $this->juegos->actualizar($id, $juego);
                    $this->redirigir('updated');
                } catch (PDOException $ex) {
                    $errores[] = 'No se pudo actualizar el juego.';
                }
            }
        }

        $this->render('editar', [
            'titulo_pagina' => 'Administración — Editar juego',
            'juego'         => $juego,
            'errores'       => $errores,
            'editoriales'   => $this->juegos->editoriales(),
            'categorias'    => $this->juegos->categorias(),
            'accion'        => 'index.php?accion=editar&id=' . $id,
            'textoBoton'    => 'Guardar cambios',
        ]);
    }

    public function eliminar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirigir();

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id) $this->redirigir('invalid');

        try {
            $status = $this->juegos->eliminar($id) > 0 ? 'deleted' : 'notfound';
        } catch (PDOException $ex) {
            $status = $ex->getCode() === '23000' ? 'fk' : 'error';
        }
        $this->redirigir($status);
    }

    // ---------- helpers privados ----------

    private function render(string $vista, array $datos = []): void
    {
        extract($datos);                       // convierte ['juego'=>...] en $juego
        $ruta_base     = '../';
        $pagina_actual = 'admin';

        // env.php ya se cargó en el ámbito global (vía conexion.php), pero este
        // método tiene su propio ámbito: hay que traer las variables a mano.
        $nombre_sitio   = $GLOBALS['nombre_sitio']   ?? 'El Rincón de Hermes';
        $email_contacto = $GLOBALS['email_contacto'] ?? '';
        $entorno        = $GLOBALS['entorno']        ?? 'local';

        require __DIR__ . '/../../includes/header.php';
        require __DIR__ . '/../../includes/nav.php';
        require __DIR__ . "/../Views/admin/juegos/$vista.php";
        require __DIR__ . '/../../includes/footer.php';
    }

    private function redirigir(string $status = ''): never
    {
        header('Location: index.php' . ($status ? "?status=$status" : ''));
        exit;
    }

    private function datosDesdePost(): array
    {
        return [
            'titulo'              => trim($_POST['titulo'] ?? ''),
            'id_editorial'        => (int) ($_POST['id_editorial'] ?? 0),
            'id_categoria'        => (int) ($_POST['id_categoria'] ?? 0),
            'jugadores_min'       => (int) ($_POST['jugadores_min'] ?? 0),
            'jugadores_max'       => (int) ($_POST['jugadores_max'] ?? 0),
            'duracion_min'        => (int) ($_POST['duracion_min'] ?? 0),
            'duracion_max'        => (int) ($_POST['duracion_max'] ?? 0),
            'edad_minima'         => (int) ($_POST['edad_minima'] ?? 0),
            'precio'              => (float) ($_POST['precio'] ?? 0),
            'stock'               => (int) ($_POST['stock'] ?? 0),
            'disponible_venta'    => isset($_POST['disponible_venta']) ? 1 : 0,
            'disponible_prestamo' => isset($_POST['disponible_prestamo']) ? 1 : 0,
            'imagen'              => trim($_POST['imagen'] ?? ''),
        ];
    }

    private function validar(array $d): array
    {
        $errores = [];

        if ($d['titulo'] === '')
            $errores[] = 'El título es obligatorio.';
        if (mb_strlen($d['titulo']) > 100)
            $errores[] = 'El título no puede superar 100 caracteres.';
        if ($d['id_editorial'] <= 0)
            $errores[] = 'Elegí una editorial.';
        if ($d['id_categoria'] <= 0)
            $errores[] = 'Elegí una categoría.';
        if ($d['jugadores_min'] < 1 || $d['jugadores_max'] < $d['jugadores_min'])
            $errores[] = 'La cantidad de jugadores no es válida.';
        if ($d['duracion_min'] < 1 || $d['duracion_max'] < $d['duracion_min'])
            $errores[] = 'La duración no es válida.';
        if ($d['precio'] < 0)
            $errores[] = 'El precio no puede ser negativo.';
        if ($d['stock'] < 0)
            $errores[] = 'El stock no puede ser negativo.';

        return $errores;
    }
}

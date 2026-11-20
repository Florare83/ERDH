<?php
class Juego
{
    public function __construct(private PDO $pdo) {}

    public function todos(): array
    {
        $sql = "SELECT j.id_juego, j.titulo, e.nombre AS editorial, c.nombre AS categoria,
                       j.precio, j.stock
                FROM juegos j
                INNER JOIN editoriales e ON e.id_editorial = j.id_editorial
                INNER JOIN categorias  c ON c.id_categoria = j.id_categoria
                ORDER BY j.id_juego DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function buscarPorId(int $id): array|false
    {
        $stmt = $this->pdo->prepare('SELECT * FROM juegos WHERE id_juego = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function crear(array $d): void
    {
        $sql = "INSERT INTO juegos
                    (titulo, id_editorial, id_categoria, jugadores_min, jugadores_max,
                     duracion_min, duracion_max, edad_minima, precio, stock,
                     disponible_venta, disponible_prestamo, imagen)
                VALUES
                    (:titulo, :id_editorial, :id_categoria, :jugadores_min, :jugadores_max,
                     :duracion_min, :duracion_max, :edad_minima, :precio, :stock,
                     :disponible_venta, :disponible_prestamo, :imagen)";
        $this->pdo->prepare($sql)->execute($this->parametros($d));
    }

    public function actualizar(int $id, array $d): void
    {
        $sql = "UPDATE juegos SET
                    titulo = :titulo, id_editorial = :id_editorial, id_categoria = :id_categoria,
                    jugadores_min = :jugadores_min, jugadores_max = :jugadores_max,
                    duracion_min = :duracion_min, duracion_max = :duracion_max,
                    edad_minima = :edad_minima, precio = :precio, stock = :stock,
                    disponible_venta = :disponible_venta,
                    disponible_prestamo = :disponible_prestamo, imagen = :imagen
                WHERE id_juego = :id";
        $this->pdo->prepare($sql)->execute($this->parametros($d) + [':id' => $id]);
    }

    /** @return int filas afectadas */
    public function eliminar(int $id): int
    {
        $stmt = $this->pdo->prepare('DELETE FROM juegos WHERE id_juego = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }

    public function editoriales(): array
    {
        $stmt = $this->pdo->prepare('SELECT id_editorial, nombre FROM editoriales ORDER BY nombre');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function categorias(): array
    {
        $stmt = $this->pdo->prepare('SELECT id_categoria, nombre FROM categorias ORDER BY id_categoria');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Evita repetir el array de 13 parámetros en crear() y actualizar()
    private function parametros(array $d): array
    {
        return [
            ':titulo'              => $d['titulo'],
            ':id_editorial'        => $d['id_editorial'],
            ':id_categoria'        => $d['id_categoria'],
            ':jugadores_min'       => $d['jugadores_min'],
            ':jugadores_max'       => $d['jugadores_max'],
            ':duracion_min'        => $d['duracion_min'],
            ':duracion_max'        => $d['duracion_max'],
            ':edad_minima'         => $d['edad_minima'],
            ':precio'              => $d['precio'],
            ':stock'               => $d['stock'],
            ':disponible_venta'    => $d['disponible_venta'],
            ':disponible_prestamo' => $d['disponible_prestamo'],
            ':imagen'              => $d['imagen'] !== '' ? $d['imagen'] : null,
        ];
    }
}
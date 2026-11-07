-- =====================================================================
-- TP6 - Consultas de prueba CRUD
-- Proyecto: El Rincón de Hermes
-- Ejecutar DESPUÉS de schema.sql
-- =====================================================================

USE rincon_de_hermes;

-- =====================================================================
-- 1) CREATE - Datos iniciales
-- =====================================================================

-- Tablas maestras
INSERT INTO roles (nombre, descripcion) VALUES
    ('admin', 'Administra el sitio, el catálogo y los eventos'),
    ('socio', 'Miembro del club, puede pedir juegos en préstamo');

INSERT INTO categorias (nombre) VALUES
    ('Infantil'),
    ('Familiar'),
    ('Experto');

INSERT INTO editoriales (nombre) VALUES
    ('Devir'),
    ('Maldon'),
    ('Multiverso'),
    ('Editorial');

INSERT INTO estados_prestamo (nombre) VALUES
    ('Pendiente'),
    ('En curso'),
    ('Devuelto');

-- Usuarios (el password debe ser un hash; este es solo de prueba)
INSERT INTO usuarios (nombre, apellido, email, password, telefono, id_rol) VALUES
    ('Flavia', 'Administradora', 'admin@rincondehermes.test', '$2y$10$hashDePruebaAdmin', '3874000001', 1),
    ('Juan',   'Pérez',          'juan@example.com',          '$2y$10$hashDePruebaSocio', '3874000002', 2);

-- Tabla principal: juegos (id_editorial / id_categoria según los inserts anteriores)
-- Editoriales: 1 Devir, 2 Maldon, 3 Multiverso, 4 Editorial
-- Categorías:  1 Infantil, 2 Familiar, 3 Experto
INSERT INTO juegos
    (titulo, id_editorial, id_categoria, jugadores_min, jugadores_max,
     duracion_min, duracion_max, edad_minima, precio, stock, imagen)
VALUES
    ('El lavarropas', 3, 1, 2, 4,  15,  30,  6,  50000.00, 3, 'img/el_lavarropas.webp'),
    ('Flamencos',     2, 1, 2, 4,  15,  30,  6,  24000.00, 5, 'img/flamencos.webp'),
    ('El Tiburon',    2, 1, 2, 4,  15,  30,  6,  40000.00, 2, 'img/el_tiburon.webp'),
    ('Esquinados',    2, 2, 2, 6,  60, 120, 12,  60000.00, 4, 'img/esquinados.webp'),
    ('Catan',         1, 2, 2, 6,  60, 120, 12,  67888.00, 6, 'img/catan.webp'),
    ('Carcassonne',   1, 2, 2, 6,  60, 120, 12,  70000.00, 3, 'img/carcassonne.webp'),
    ('Faraway',       1, 3, 2, 6,  60, 120, 12,  30000.00, 2, 'img/faraway.webp'),
    ('Exit',          4, 3, 2, 6,  60, 120, 12,  45000.00, 4, 'img/exit.webp'),
    ('Ierusalem',     1, 3, 2, 6,  60, 120, 12,  90000.00, 1, 'img/ierusalem.webp');

-- Eventos (cronograma de club.php)
INSERT INTO eventos (titulo, descripcion, fecha, hora_inicio, hora_fin, lugar, imagen) VALUES
    ('Tarde de juegos',
     'Una tarde mensual para descubrir juegos de mesa modernos',
     '2026-09-27', '17:00:00', '21:00:00', 'Fundación Copaipa - Zuviría 291', 'img/eventos.jpeg'),
    ('Torneo de Catán',
     'Torneo abierto a todos los niveles. Inscripción previa por WhatsApp',
     '2026-09-27', '17:00:00', '21:00:00', 'Fundación Copaipa - Zuviría 291', 'img/catan.webp');

-- Préstamos de prueba (usuario 2 = Juan)
INSERT INTO prestamos (id_usuario, id_juego, id_estado, fecha_prestamo) VALUES
    (2, 5, 2, '2026-10-20'),   -- Catan, en curso
    (2, 2, 1, '2026-10-28');   -- Flamencos, pendiente

-- Inscripción N:M
INSERT INTO inscripciones (id_usuario, id_evento) VALUES (2, 1), (2, 2);

-- Mensaje de contacto de prueba
INSERT INTO mensajes_contacto (nombre, email, mensaje) VALUES
    ('Mensaje de prueba', 'prueba@example.com', 'Mensaje que se borrará en el DELETE de prueba');

-- =====================================================================
-- 2) READ
-- =====================================================================

-- 2.a) SELECT con WHERE y ORDER BY:
--      juegos de la categoría Familiar (id 2) ordenados por precio ascendente
SELECT id_juego, titulo, precio, stock
FROM juegos
WHERE id_categoria = 2
ORDER BY precio ASC;

-- 2.b) INNER JOIN (juegos + editorial + categoría):
--      catálogo completo como se muestra en las páginas de tienda
SELECT j.titulo,
       e.nombre AS editorial,
       c.nombre AS categoria,
       CONCAT(j.jugadores_min, '-', j.jugadores_max) AS jugadores,
       CONCAT(j.duracion_min, '-', j.duracion_max, ' min') AS duracion,
       CONCAT(j.edad_minima, '+') AS edad,
       j.precio
FROM juegos j
INNER JOIN editoriales e ON j.id_editorial = e.id_editorial
INNER JOIN categorias  c ON j.id_categoria = c.id_categoria
ORDER BY c.nombre, j.titulo;

-- 2.c) INNER JOIN (préstamos + usuario + juego + estado)
SELECT CONCAT(u.nombre, ' ', u.apellido) AS socio,
       j.titulo AS juego,
       ep.nombre AS estado,
       p.fecha_prestamo
FROM prestamos p
INNER JOIN usuarios         u  ON p.id_usuario = u.id_usuario
INNER JOIN juegos           j  ON p.id_juego   = j.id_juego
INNER JOIN estados_prestamo ep ON p.id_estado  = ep.id_estado
ORDER BY p.fecha_prestamo DESC;

-- 2.d) Búsqueda por título (equivale a buscar.php, versión SQL)
--      En PHP (TP7) se hará con consulta preparada: WHERE titulo LIKE :q
SELECT titulo, precio
FROM juegos
WHERE titulo LIKE '%cat%'
ORDER BY titulo;

-- =====================================================================
-- 3) UPDATE (siempre con WHERE)
-- =====================================================================

-- Cambiar el precio de Catan
UPDATE juegos
SET precio = 72000.00
WHERE titulo = 'Catan';

-- Marcar un préstamo como devuelto
UPDATE prestamos
SET id_estado = 3, fecha_devolucion = '2026-10-29'
WHERE id_prestamo = 1;

-- Verificación
SELECT titulo, precio FROM juegos WHERE titulo = 'Catan';

-- =====================================================================
-- 4) DELETE (siempre con WHERE)
-- =====================================================================

-- Dar de baja el mensaje de prueba
DELETE FROM mensajes_contacto
WHERE email = 'prueba@example.com';

-- Verificación
SELECT COUNT(*) AS mensajes_restantes FROM mensajes_contacto;

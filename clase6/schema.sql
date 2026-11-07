-- =====================================================================
-- TP6 - Esquema relacional en MySQL
-- Proyecto: El Rincón de Hermes (club y tienda de juegos de mesa)
-- Ejecutar en phpMyAdmin / XAMPP / Laragon
-- =====================================================================

CREATE DATABASE IF NOT EXISTS rincon_de_hermes
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE rincon_de_hermes;

-- Para poder re-ejecutar el script sin errores (orden inverso a las FK)
DROP TABLE IF EXISTS inscripciones;
DROP TABLE IF EXISTS prestamos;
DROP TABLE IF EXISTS mensajes_contacto;
DROP TABLE IF EXISTS eventos;
DROP TABLE IF EXISTS juegos;
DROP TABLE IF EXISTS estados_prestamo;
DROP TABLE IF EXISTS editoriales;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS roles;

-- ---------------------------------------------------------------------
-- TABLAS MAESTRAS
-- ---------------------------------------------------------------------

-- Roles de usuario (admin, socio, visitante)
CREATE TABLE roles (
    id_rol      INT AUTO_INCREMENT PRIMARY KEY,
    nombre      VARCHAR(30)  NOT NULL UNIQUE,
    descripcion VARCHAR(150) NULL
) ENGINE=InnoDB;

-- Categorías de juego (Infantil, Familiar, Experto)
CREATE TABLE categorias (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nombre       VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Editoriales (Devir, Maldon, Multiverso, ...)
CREATE TABLE editoriales (
    id_editorial INT AUTO_INCREMENT PRIMARY KEY,
    nombre       VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Estados de un préstamo (Pendiente, En curso, Devuelto)
CREATE TABLE estados_prestamo (
    id_estado INT AUTO_INCREMENT PRIMARY KEY,
    nombre    VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- USUARIOS
-- ---------------------------------------------------------------------
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(60)  NOT NULL,
    apellido   VARCHAR(60)  NOT NULL,
    email      VARCHAR(120) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,          -- hash generado con password_hash()
    telefono   VARCHAR(20)  NULL,
    id_rol     INT          NOT NULL,
    activo     TINYINT(1)   NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_usuarios_rol
        FOREIGN KEY (id_rol) REFERENCES roles (id_rol)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- TABLA PRINCIPAL DE NEGOCIO: JUEGOS
-- Un mismo juego puede estar a la venta, en préstamo, o ambas cosas.
-- ---------------------------------------------------------------------
CREATE TABLE juegos (
    id_juego         INT AUTO_INCREMENT PRIMARY KEY,
    titulo           VARCHAR(100)  NOT NULL,
    id_editorial     INT           NOT NULL,
    id_categoria     INT           NOT NULL,
    jugadores_min    TINYINT UNSIGNED NOT NULL,
    jugadores_max    TINYINT UNSIGNED NOT NULL,
    duracion_min     SMALLINT UNSIGNED NOT NULL,   -- minutos
    duracion_max     SMALLINT UNSIGNED NOT NULL,   -- minutos
    edad_minima      TINYINT UNSIGNED NOT NULL,
    precio           DECIMAL(10,2) NOT NULL,
    stock            INT           NOT NULL DEFAULT 0,
    disponible_venta TINYINT(1)    NOT NULL DEFAULT 1,
    disponible_prestamo TINYINT(1) NOT NULL DEFAULT 1,
    imagen           VARCHAR(150)  NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_juegos_editorial
        FOREIGN KEY (id_editorial) REFERENCES editoriales (id_editorial),
    CONSTRAINT fk_juegos_categoria
        FOREIGN KEY (id_categoria) REFERENCES categorias (id_categoria)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- PRÉSTAMOS: un usuario pide un juego en préstamo
-- ---------------------------------------------------------------------
CREATE TABLE prestamos (
    id_prestamo      INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario       INT  NOT NULL,
    id_juego         INT  NOT NULL,
    id_estado        INT  NOT NULL,
    fecha_prestamo   DATE NOT NULL,
    fecha_devolucion DATE NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_prestamos_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario),
    CONSTRAINT fk_prestamos_juego
        FOREIGN KEY (id_juego) REFERENCES juegos (id_juego),
    CONSTRAINT fk_prestamos_estado
        FOREIGN KEY (id_estado) REFERENCES estados_prestamo (id_estado)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- EVENTOS del club (cronograma)
-- ---------------------------------------------------------------------
CREATE TABLE eventos (
    id_evento   INT AUTO_INCREMENT PRIMARY KEY,
    titulo      VARCHAR(100) NOT NULL,
    descripcion TEXT         NULL,
    fecha       DATE         NOT NULL,
    hora_inicio TIME         NOT NULL,
    hora_fin    TIME         NOT NULL,
    lugar       VARCHAR(150) NOT NULL,
    imagen      VARCHAR(150) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- TABLA DE RELACIÓN N:M  usuarios <-> eventos (inscripción a eventos)
-- ---------------------------------------------------------------------
CREATE TABLE inscripciones (
    id_usuario INT NOT NULL,
    id_evento  INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_evento),
    CONSTRAINT fk_insc_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id_usuario)
        ON DELETE CASCADE,
    CONSTRAINT fk_insc_evento
        FOREIGN KEY (id_evento) REFERENCES eventos (id_evento)
        ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- MENSAJES del formulario contacto.php (nombre, email, mensaje)
-- ---------------------------------------------------------------------
CREATE TABLE mensajes_contacto (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(60)  NOT NULL,
    email      VARCHAR(120) NOT NULL,
    mensaje    TEXT         NOT NULL,
    leido      TINYINT(1)   NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- ÍNDICES DE RENDIMIENTO
-- ---------------------------------------------------------------------
-- Filtrado de juegos por categoría (páginas tienda-*.php / prestamo-*.php)
CREATE INDEX idx_juegos_categoria ON juegos (id_categoria);
-- Búsqueda de juegos por título (buscar.php)
CREATE INDEX idx_juegos_titulo ON juegos (titulo);
-- Consulta de préstamos por estado
CREATE INDEX idx_prestamos_estado ON prestamos (id_estado);
-- Próximos eventos por fecha
CREATE INDEX idx_eventos_fecha ON eventos (fecha);

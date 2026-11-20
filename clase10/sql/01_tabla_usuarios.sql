-- TP8 - Ejercicio 1: tabla usuarios con la estructura pedida en la consigna
USE rincon_de_hermes;

SET FOREIGN_KEY_CHECKS = 0;

-- Se eliminan las tablas que dependían de la tabla usuarios anterior
DROP TABLE IF EXISTS inscripciones;
DROP TABLE IF EXISTS prestamos;
DROP TABLE IF EXISTS usuarios;

SET FOREIGN_KEY_CHECKS = 1;

-- Tabla usuarios (estructura de la consigna del TP8)
CREATE TABLE usuarios (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    nombre     VARCHAR(100) NOT NULL,
    email      VARCHAR(120) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,                 -- guarda el hash de password_hash()
    rol        VARCHAR(20)  NOT NULL DEFAULT 'usuario', -- 'admin' o 'usuario'
    created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_usuarios_rol CHECK (rol IN ('admin', 'usuario'))
) ENGINE=InnoDB;

-- Se recrean las tablas que dependen de usuarios, apuntando a usuarios.id
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
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id),
    CONSTRAINT fk_prestamos_juego
        FOREIGN KEY (id_juego) REFERENCES juegos (id_juego),
    CONSTRAINT fk_prestamos_estado
        FOREIGN KEY (id_estado) REFERENCES estados_prestamo (id_estado)
) ENGINE=InnoDB;

CREATE INDEX idx_prestamos_estado ON prestamos (id_estado);

CREATE TABLE inscripciones (
    id_usuario INT NOT NULL,
    id_evento  INT NOT NULL,
    fecha_inscripcion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_usuario, id_evento),
    CONSTRAINT fk_insc_usuario
        FOREIGN KEY (id_usuario) REFERENCES usuarios (id)
        ON DELETE CASCADE,
    CONSTRAINT fk_insc_evento
        FOREIGN KEY (id_evento) REFERENCES eventos (id_evento)
        ON DELETE CASCADE
) ENGINE=InnoDB;
-- Base de datos del sitio Fronda
-- Ejecutar una vez en MySQL (phpMyAdmin > SQL, o: mysql -u root -p < database/schema.sql)

CREATE DATABASE IF NOT EXISTS fronda
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE fronda;

CREATE TABLE IF NOT EXISTS Clientes (
    id          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
    nombre      VARCHAR(120)  NOT NULL,
    domicilio   VARCHAR(200)  NOT NULL,
    telefono    VARCHAR(20)   NOT NULL,
    correo      VARCHAR(150)  NOT NULL,
    comentarios TEXT          NOT NULL,
    creado_en   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    INDEX idx_clientes_correo (correo),
    INDEX idx_clientes_creado_en (creado_en)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;

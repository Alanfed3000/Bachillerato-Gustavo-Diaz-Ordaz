-- Crear la base de datos con codificación UTF-8
-- 1. Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS pruebas CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pruebas;

-- Crear la tabla de estudiantes
CREATE TABLE IF NOT EXISTS estudiantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido_paterno VARCHAR(100),
    apellido_materno VARCHAR(100),
    fecha_nacimiento DATE,
    sexo ENUM('Masculino', 'Femenino', 'Otro'),
    curp VARCHAR(18) UNIQUE,
    telefono VARCHAR(10),
    correo VARCHAR(100),
    nia VARCHAR(8) UNIQUE, 
    grado ENUM('1°', '2°', '3°'),
    grupo ENUM('A', 'B', 'C'),
    usuario VARCHAR(8) UNIQUE NOT NULL,
    contrasena_hash TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar datos de ejemplo en productos
INSERT INTO estudiantes VALUES
( 'Ali ', 'Barragan', 'Marquez', 'BAPD041124MPLRXLA7', '2481338690','12345679'),
( 'Martìn ', 'Marquez', 'Jimenez', 'MAJM050602HPLRMRA5', '2481429390','78945213');



CREATE DATABASE IngSoftware;

CREATE TABLE usuarios (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    Correo VARCHAR(255) NOT NULL UNIQUE,
    Password VARCHAR(255) NOT NULL,
    Edad INT,
    Sexo INT NOT NULL
);

-- Usuario de prueba raul 1234

-- 1. Crear un nuevo usuario
CREATE USER 'admin'@'localhost' IDENTIFIED BY '1234';

-- 2. Conceder todos los privilegios en una base de datos específica
GRANT ALL PRIVILEGES ON basededatos.* TO 'admin'@'localhost';

-- 3. Aplicar los cambios
FLUSH PRIVILEGES;
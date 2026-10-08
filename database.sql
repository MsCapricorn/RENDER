-- Datos de ejemplo. Ejecútalo en Railway (pestaña Data > Query del servicio MySQL)
-- solo si tu base de datos todavía no tiene tablas.
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    existencia INT NOT NULL DEFAULT 0
);

INSERT INTO productos (nombre, precio, existencia) VALUES
('Teclado mecánico', 899.00, 15),
('Mouse inalámbrico', 349.50, 40),
('Monitor 24 pulgadas', 2799.00, 8),
('Audífonos', 599.90, 22);

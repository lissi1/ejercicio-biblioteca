
DROP DATABASE IF EXISTS biblioteca;
CREATE DATABASE biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca;


CREATE TABLE libros (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    titulo            VARCHAR(200) NOT NULL,
    autor             VARCHAR(150) NOT NULL,
    isbn              VARCHAR(20)  NOT NULL UNIQUE,
    anio_publicacion  YEAR         NOT NULL,
    disponible        BOOLEAN      NOT NULL DEFAULT TRUE
);


CREATE TABLE prestamos (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    libro_id          INT  NOT NULL,
    nombre_socio      VARCHAR(100) NOT NULL,
    fecha_prestamo    DATE NOT NULL,
    fecha_devolucion  DATE NULL,
    CONSTRAINT fk_prestamos_libro
        FOREIGN KEY (libro_id) REFERENCES libros(id)
);


INSERT INTO libros (titulo, autor, isbn, anio_publicacion, disponible) VALUES
('El ingenioso hidalgo Don Quijote', 'Miguel de Cervantes',   'ISBN-0001', 2005, FALSE), -- prestamo activo
('Cien anios de soledad',            'Gabriel Garcia Marquez','ISBN-0002', 1967, FALSE), -- prestamo activo (2o prestamo)
('1984',                             'George Orwell',         'ISBN-0003', 1949, FALSE), -- prestamo activo
('Fahrenheit 451',                   'Ray Bradbury',          'ISBN-0004', 1953, TRUE),
('Rayuela',                          'Julio Cortazar',        'ISBN-0005', 1963, TRUE),
('La sombra del viento',             'Carlos Ruiz Zafon',     'ISBN-0006', 2001, TRUE);


INSERT INTO prestamos (libro_id, nombre_socio, fecha_prestamo, fecha_devolucion) VALUES
(1, 'Ana Perez',    '2026-06-01', NULL),          -- activo
(2, 'Luis Gomez',   '2026-05-10', '2026-05-24'),  -- devuelto (historial)
(2, 'Carlos Diaz',  '2026-06-20', NULL),          -- activo (2o prestamo del mismo libro)
(3, 'Marta Ruiz',   '2026-06-15', NULL);          -- activo

<?php
require_once __DIR__ . '/../models/Libro.php';
require_once __DIR__ . '/../models/Prestamo.php';

function accion_prestamos_nuevo(Libro $libros): void {
    $librosDisponibles = $libros->disponibles();
    $tituloPagina       = 'Nuevo prestamo';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/prestamos/nuevo.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_prestamos_crear(Libro $libros, Prestamo $prestamos): void {
    $libroId      = (int)($_POST['libro_id'] ?? -1);
    $nombreSocio  = trim($_POST['nombre_socio'] ?? '');
    $fechaPrestamo = trim($_POST['fecha_prestamo'] ?? '') ?: date('Y-m-d');

    $libro = $libros->porId($libroId);

    
    if (!$libro || !$libro['disponible'] || $nombreSocio === '') {
        $librosDisponibles = $libros->disponibles();
        $error             = 'Ese libro ya no esta disponible o falta el nombre del socio.';
        $tituloPagina      = 'Nuevo prestamo';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/prestamos/nuevo.php';
        require __DIR__ . '/../views/layouts/footer.php';
        return;
    }

    $prestamos->crear($libroId, $nombreSocio, $fechaPrestamo);
    $libros->marcarDisponible($libroId, false);

    header('Location: index.php?accion=prestamos_activos');
    exit;
}

function accion_prestamos_activos(Prestamo $prestamos): void {
    $activos      = $prestamos->activos();
    $tituloPagina = 'Prestamos activos';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/prestamos/activos.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_prestamos_devolver(Libro $libros, Prestamo $prestamos): void {
    $id       = (int)($_POST['id'] ?? -1);
    $prestamo = $prestamos->porId($id);

    if ($prestamo && $prestamo['fecha_devolucion'] === null) {
        $prestamos->devolver($id, date('Y-m-d'));
        $libros->marcarDisponible($prestamo['libro_id'], true);
    }

    header('Location: index.php?accion=prestamos_activos');
    exit;
}

<?php
// Enrutador. Crea la conexion y los dos modelos una sola vez y los pasa
// a la funcion del controlador que toque segun el parametro "accion".

require_once 'config/Conexion.php';
require_once 'models/Libro.php';
require_once 'models/Prestamo.php';
require_once 'controllers/libros_controller.php';
require_once 'controllers/prestamos_controller.php';

$pdo = Conexion::obtener();

$modeloLibros    = new Libro($pdo);
$modeloPrestamos = new Prestamo($pdo);

$accion = $_GET['accion'] ?? 'libros_listar';

switch ($accion) {
    case 'libros_listar':
        accion_libros_listar($modeloLibros);
        break;
    case 'libros_ver':
        accion_libros_ver($modeloLibros, $modeloPrestamos);
        break;
    case 'libros_nuevo':
        accion_libros_nuevo();
        break;
    case 'libros_crear':
        accion_libros_crear($modeloLibros);
        break;
    case 'libros_editar':
        accion_libros_editar($modeloLibros);
        break;
    case 'libros_actualizar':
        accion_libros_actualizar($modeloLibros);
        break;
    case 'confirmar_eliminar':
        accion_libros_confirmar_eliminar($modeloLibros, $modeloPrestamos);
        break;
    case 'libros_eliminar':
        accion_libros_eliminar($modeloLibros, $modeloPrestamos);
        break;

    case 'prestamos_nuevo':
        accion_prestamos_nuevo($modeloLibros);
        break;
    case 'prestamos_crear':
        accion_prestamos_crear($modeloLibros, $modeloPrestamos);
        break;
    case 'prestamos_activos':
        accion_prestamos_activos($modeloPrestamos);
        break;
    case 'prestamos_devolver':
        accion_prestamos_devolver($modeloLibros, $modeloPrestamos);
        break;

    default:
        accion_libros_listar($modeloLibros);
}

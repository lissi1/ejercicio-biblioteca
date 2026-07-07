<?php
require_once __DIR__ . '/../models/Libro.php';
require_once __DIR__ . '/../models/Prestamo.php';

function accion_libros_listar(Libro $libros): void {
    $listaLibros  = $libros->todos();
    $tituloPagina = 'Catalogo';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/libros/lista.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_libros_ver(Libro $libros, Prestamo $prestamos): void {
    $id    = (int)($_GET['id'] ?? -1);
    $libro = $libros->porId($id);

    if (!$libro) {
        header('Location: index.php');
        exit;
    }

    $historial    = $prestamos->porLibro($id);
    $tituloPagina = 'Ficha del libro';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/libros/ver.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_libros_nuevo(): void {
    $tituloPagina = 'Nuevo libro';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/libros/nuevo.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_libros_crear(Libro $libros): void {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor']  ?? '');
    $isbn   = trim($_POST['isbn']   ?? '');
    $anio   = (int)($_POST['anio_publicacion'] ?? 0);

    if ($titulo === '' || $autor === '' || $isbn === '' || $anio <= 0) {
        $error        = 'Rellena todos los campos correctamente.';
        $valores      = compact('titulo', 'autor', 'isbn', 'anio');
        $tituloPagina = 'Nuevo libro';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/libros/nuevo.php';
        require __DIR__ . '/../views/layouts/footer.php';
        return;
    }

    try {
        $libros->crear($titulo, $autor, $isbn, $anio);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        
        $error        = 'No se ha podido guardar el libro. Comprueba que el ISBN no este repetido.';
        $valores      = compact('titulo', 'autor', 'isbn', 'anio');
        $tituloPagina = 'Nuevo libro';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/libros/nuevo.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}

function accion_libros_editar(Libro $libros): void {
    $id    = (int)($_GET['id'] ?? -1);
    $libro = $libros->porId($id);

    if (!$libro) {
        header('Location: index.php');
        exit;
    }

    $tituloPagina = 'Editar libro';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/libros/editar.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_libros_actualizar(Libro $libros): void {
    $id     = (int)($_POST['id'] ?? -1);
    $titulo = trim($_POST['titulo'] ?? '');
    $autor  = trim($_POST['autor']  ?? '');
    $isbn   = trim($_POST['isbn']   ?? '');
    $anio   = (int)($_POST['anio_publicacion'] ?? 0);

    $libro = $libros->porId($id);
    if (!$libro) {
        header('Location: index.php');
        exit;
    }

    if ($titulo === '' || $autor === '' || $isbn === '' || $anio <= 0) {
        $error        = 'Rellena todos los campos correctamente.';
        $libro        = ['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'isbn' => $isbn, 'anio_publicacion' => $anio];
        $tituloPagina = 'Editar libro';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/libros/editar.php';
        require __DIR__ . '/../views/layouts/footer.php';
        return;
    }

    try {
        $libros->actualizar($id, $titulo, $autor, $isbn, $anio);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        $error        = 'No se ha podido guardar. Comprueba que el ISBN no este repetido.';
        $libro        = ['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'isbn' => $isbn, 'anio_publicacion' => $anio];
        $tituloPagina = 'Editar libro';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/libros/editar.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}

function accion_libros_confirmar_eliminar(Libro $libros, Prestamo $prestamos): void {
    $id    = (int)($_GET['id'] ?? -1);
    $libro = $libros->porId($id);

    if (!$libro) {
        header('Location: index.php');
        exit;
    }

    $prestamoActivo = $prestamos->tienePrestamoActivo($id);
    $tituloPagina   = 'Eliminar libro';

    require __DIR__ . '/../views/layouts/header.php';
    require __DIR__ . '/../views/libros/confirmar_eliminar.php';
    require __DIR__ . '/../views/layouts/footer.php';
}

function accion_libros_eliminar(Libro $libros, Prestamo $prestamos): void {
    $id = (int)($_POST['id'] ?? -1);

   
    if ($prestamos->tienePrestamoActivo($id)) {
        header('Location: index.php?accion=confirmar_eliminar&id=' . $id);
        exit;
    }

    try {
        $libros->eliminar($id);
        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
       
        $libro          = $libros->porId($id);
        $prestamoActivo = false;
        $error          = 'No se puede eliminar: el libro tiene prestamos en su historial.';
        $tituloPagina   = 'Eliminar libro';

        require __DIR__ . '/../views/layouts/header.php';
        require __DIR__ . '/../views/libros/confirmar_eliminar.php';
        require __DIR__ . '/../views/layouts/footer.php';
    }
}

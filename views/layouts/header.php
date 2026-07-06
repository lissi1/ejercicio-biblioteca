<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($tituloPagina ?? 'Biblioteca') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="index.php">Biblioteca Municipal</a>
            <div class="navbar-nav">
                <a class="nav-link" href="index.php?accion=libros_listar">Catalogo</a>
                <a class="nav-link" href="index.php?accion=libros_nuevo">Nuevo libro</a>
                <a class="nav-link" href="index.php?accion=prestamos_nuevo">Nuevo prestamo</a>
                <a class="nav-link" href="index.php?accion=prestamos_activos">Prestamos activos</a>
            </div>
        </div>
    </nav>
    <div class="container mb-5">

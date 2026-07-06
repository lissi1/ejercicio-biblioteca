<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Catalogo</h2>
    <a href="index.php?accion=libros_nuevo" class="btn btn-primary">+ Nuevo libro</a>
</div>

<?php if (empty($listaLibros)): ?>
    <div class="alert alert-info">Todavia no hay libros en el catalogo.</div>
<?php else: ?>
    <table class="table table-striped align-middle bg-white">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Anio</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listaLibros as $l): ?>
                <tr>
                    <td><?= htmlspecialchars($l['titulo']) ?></td>
                    <td><?= htmlspecialchars($l['autor']) ?></td>
                    <td><?= htmlspecialchars($l['isbn']) ?></td>
                    <td><?= $l['anio_publicacion'] ?></td>
                    <td>
                        <?php if ($l['disponible']): ?>
                            <span class="badge bg-success">Disponible</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Prestado</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-end">
                        <a href="index.php?accion=libros_ver&id=<?= $l['id'] ?>" class="btn btn-sm btn-outline-primary">Ver</a>
                        <a href="index.php?accion=libros_editar&id=<?= $l['id'] ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                        <a href="index.php?accion=confirmar_eliminar&id=<?= $l['id'] ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

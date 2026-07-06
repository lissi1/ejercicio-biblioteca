<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Prestamos activos</h2>
    <a href="index.php?accion=prestamos_nuevo" class="btn btn-primary">+ Nuevo prestamo</a>
</div>

<?php if (empty($activos)): ?>
    <div class="alert alert-info">No hay ningun prestamo activo en este momento.</div>
<?php else: ?>
    <table class="table table-striped align-middle bg-white">
        <thead>
            <tr>
                <th>Libro</th>
                <th>Socio</th>
                <th>Fecha de prestamo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['titulo']) ?></td>
                    <td><?= htmlspecialchars($p['nombre_socio']) ?></td>
                    <td><?= $p['fecha_prestamo'] ?></td>
                    <td class="text-end">
                        <form method="POST" action="index.php?accion=prestamos_devolver" class="d-inline">
                            <input type="hidden" name="id" value="<?= $p['id'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-success">Devolver</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

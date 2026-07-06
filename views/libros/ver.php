<div class="row justify-content-center">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h3><?= htmlspecialchars($libro['titulo']) ?></h3>
                <p class="text-muted mb-2"><?= htmlspecialchars($libro['autor']) ?> · <?= $libro['anio_publicacion'] ?></p>
                <p class="mb-2">ISBN: <?= htmlspecialchars($libro['isbn']) ?></p>
                <?php if ($libro['disponible']): ?>
                    <span class="badge bg-success">Disponible</span>
                <?php else: ?>
                    <span class="badge bg-secondary">Prestado actualmente</span>
                <?php endif; ?>
                <div class="mt-3">
                    <a href="index.php?accion=libros_editar&id=<?= $libro['id'] ?>" class="btn btn-sm btn-outline-secondary">Editar</a>
                    <a href="index.php?accion=libros_listar" class="btn btn-sm btn-outline-secondary">Volver al catalogo</a>
                </div>
            </div>
        </div>

        <h4>Historial de prestamos</h4>
        <?php if (empty($historial)): ?>
            <div class="alert alert-info">Este libro todavia no se ha prestado nunca.</div>
        <?php else: ?>
            <table class="table table-sm bg-white">
                <thead>
                    <tr>
                        <th>Socio</th>
                        <th>Fecha prestamo</th>
                        <th>Fecha devolucion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historial as $h): ?>
                        <tr>
                            <td><?= htmlspecialchars($h['nombre_socio']) ?></td>
                            <td><?= $h['fecha_prestamo'] ?></td>
                            <td>
                                <?php if ($h['fecha_devolucion']): ?>
                                    <?= $h['fecha_devolucion'] ?>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Activo</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">Registrar prestamo</div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php if (empty($librosDisponibles)): ?>
                    <div class="alert alert-info">
                        No hay ningun libro disponible ahora mismo para prestar.
                    </div>
                <?php else: ?>
                    <form method="POST" action="index.php?accion=prestamos_crear">
                        <div class="mb-3">
                            <label class="form-label">Libro *</label>
                            <select class="form-select" name="libro_id" required>
                                <option value="">-- Selecciona un libro --</option>
                                <?php foreach ($librosDisponibles as $l): ?>
                                    <option value="<?= $l['id'] ?>">
                                        <?= htmlspecialchars($l['titulo']) ?> — <?= htmlspecialchars($l['autor']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombre del socio *</label>
                            <input type="text" class="form-control" name="nombre_socio" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Fecha de prestamo</label>
                            <input type="date" class="form-control" name="fecha_prestamo" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Registrar prestamo</button>
                            <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">Editar libro</div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="index.php?accion=libros_actualizar">
                    <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Titulo *</label>
                        <input type="text" class="form-control" name="titulo" required
                               value="<?= htmlspecialchars($libro['titulo']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor *</label>
                        <input type="text" class="form-control" name="autor" required
                               value="<?= htmlspecialchars($libro['autor']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ISBN *</label>
                        <input type="text" class="form-control" name="isbn" required
                               value="<?= htmlspecialchars($libro['isbn']) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anio de publicacion *</label>
                        <input type="number" class="form-control" name="anio_publicacion" required
                               min="1901" max="2155"
                               value="<?= htmlspecialchars((string) $libro['anio_publicacion']) ?>">
                    </div>
                    <p class="text-muted small">
                        La disponibilidad no se edita aqui: la controla el registro de prestamos y devoluciones.
                    </p>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

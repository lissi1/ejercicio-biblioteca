<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">Nuevo libro</div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <form method="POST" action="index.php?accion=libros_crear">
                    <div class="mb-3">
                        <label class="form-label">Titulo *</label>
                        <input type="text" class="form-control" name="titulo" required
                               value="<?= htmlspecialchars($valores['titulo'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor *</label>
                        <input type="text" class="form-control" name="autor" required
                               value="<?= htmlspecialchars($valores['autor'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ISBN *</label>
                        <input type="text" class="form-control" name="isbn" required
                               value="<?= htmlspecialchars($valores['isbn'] ?? '') ?>">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Anio de publicacion *</label>
                        <input type="number" class="form-control" name="anio_publicacion" required
                               min="1901" max="2155"
                               value="<?= htmlspecialchars($valores['anio'] ?? '') ?>">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="index.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

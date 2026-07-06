<div class="row justify-content-center">
    <div class="col-12 col-md-6">
        <div class="card border-danger shadow-sm">
            <div class="card-header bg-danger text-white fw-bold">Confirmar eliminacion</div>
            <div class="card-body text-center py-4">
                <p class="fs-5 mb-1">¿Eliminar el libro?</p>
                <p class="fw-bold fs-4">"<?= htmlspecialchars($libro['titulo']) ?>"</p>

                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <a href="index.php" class="btn btn-outline-secondary px-4">Volver</a>
                <?php elseif ($prestamoActivo): ?>
                    <div class="alert alert-warning">
                        Este libro tiene un prestamo activo ahora mismo.
                        No se puede eliminar hasta que se devuelva.
                    </div>
                    <a href="index.php" class="btn btn-outline-secondary px-4">Volver</a>
                <?php else: ?>
                    <div class="alert alert-warning">
                        Esta accion <strong>no se puede deshacer</strong>.
                    </div>
                    <div class="d-flex gap-3 justify-content-center">
                        <form method="POST" action="index.php?accion=libros_eliminar">
                            <input type="hidden" name="id" value="<?= $libro['id'] ?>">
                            <button type="submit" class="btn btn-danger px-4">Si, eliminar</button>
                        </form>
                        <a href="index.php" class="btn btn-outline-secondary px-4">Cancelar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

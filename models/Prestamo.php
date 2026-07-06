<?php

class Prestamo {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function porId(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM prestamos WHERE id = ?');
        $stmt->execute([$id]);
        $prestamo = $stmt->fetch();

        return $prestamo ?: null;
    }

    
    public function porLibro(int $libroId): array {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM prestamos WHERE libro_id = ? ORDER BY fecha_prestamo DESC'
        );
        $stmt->execute([$libroId]);

        return $stmt->fetchAll();
    }

   
    public function activos(): array {
        $stmt = $this->pdo->prepare(
            'SELECT p.id, p.libro_id, p.nombre_socio, p.fecha_prestamo, l.titulo
               FROM prestamos p
               JOIN libros l ON l.id = p.libro_id
              WHERE p.fecha_devolucion IS NULL
           ORDER BY p.fecha_prestamo ASC'
        );
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function tienePrestamoActivo(int $libroId): bool {
        $stmt = $this->pdo->prepare(
            'SELECT COUNT(*) FROM prestamos WHERE libro_id = ? AND fecha_devolucion IS NULL'
        );
        $stmt->execute([$libroId]);

        return $stmt->fetchColumn() > 0;
    }

    public function crear(int $libroId, string $nombreSocio, string $fechaPrestamo): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO prestamos (libro_id, nombre_socio, fecha_prestamo, fecha_devolucion)
             VALUES (:libro_id, :nombre_socio, :fecha_prestamo, NULL)'
        );
        $stmt->execute([
            ':libro_id'       => $libroId,
            ':nombre_socio'   => $nombreSocio,
            ':fecha_prestamo' => $fechaPrestamo,
        ]);

        return (int) $this->pdo->lastInsertId();
    }

   
    public function devolver(int $id, string $fechaDevolucion): bool {
        $stmt = $this->pdo->prepare(
            'UPDATE prestamos SET fecha_devolucion = ? WHERE id = ? AND fecha_devolucion IS NULL'
        );
        $stmt->execute([$fechaDevolucion, $id]);

        return $stmt->rowCount() > 0;
    }
}

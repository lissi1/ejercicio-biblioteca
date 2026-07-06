<?php


class Libro {

    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function todos(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM libros ORDER BY titulo ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function porId(int $id): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM libros WHERE id = ?');
        $stmt->execute([$id]);
        $libro = $stmt->fetch();

        return $libro ?: null;
    }

    
    public function disponibles(): array {
        $stmt = $this->pdo->prepare('SELECT * FROM libros WHERE disponible = 1 ORDER BY titulo ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function crear(string $titulo, string $autor, string $isbn, int $anio): int {
        $stmt = $this->pdo->prepare(
            'INSERT INTO libros (titulo, autor, isbn, anio_publicacion, disponible)
             VALUES (:titulo, :autor, :isbn, :anio, 1)'
        );
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor'  => $autor,
            ':isbn'   => $isbn,
            ':anio'   => $anio,
        ]);

        return (int) $this->pdo->lastInsertId();
    }

    public function actualizar(int $id, string $titulo, string $autor, string $isbn, int $anio): bool {
        $stmt = $this->pdo->prepare(
            'UPDATE libros SET titulo = :titulo, autor = :autor, isbn = :isbn, anio_publicacion = :anio
             WHERE id = :id'
        );
        $stmt->execute([
            ':titulo' => $titulo,
            ':autor'  => $autor,
            ':isbn'   => $isbn,
            ':anio'   => $anio,
            ':id'     => $id,
        ]);

        return $stmt->rowCount() > 0;
    }

    
    public function marcarDisponible(int $id, bool $disponible): bool {
        $stmt = $this->pdo->prepare('UPDATE libros SET disponible = ? WHERE id = ?');
        $stmt->execute([$disponible ? 1 : 0, $id]);

        return $stmt->rowCount() > 0;
    }

    public function eliminar(int $id): bool {
        $stmt = $this->pdo->prepare('DELETE FROM libros WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->rowCount() > 0;
    }
}

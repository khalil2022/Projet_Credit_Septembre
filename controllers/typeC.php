<?php
require_once '../../config.php';
require_once '../../entities/type.php';

class TypeController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function getAll(): array {
        $query = "SELECT * FROM types";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?Type {
        $query = "SELECT * FROM types WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $typeData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($typeData) {
            return new Type($typeData['id'], $typeData['name']);
        }

        return null;
    }

    public function create(Type $type): void {
        $query = "INSERT INTO types (name) VALUES (:name)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':name' => $type->getName()]);
    }

    public function update(Type $type): void {
        $query = "UPDATE types SET name = :name WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $type->getId(), ':name' => $type->getName()]);
    }

    public function delete(int $id): void {
        $query = "DELETE FROM types WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
    }
}

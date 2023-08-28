<?php
require_once '../../config.php';
require_once '../../entities/formation.php';

class FormationController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function getAll(): array {
        $query = "SELECT * FROM formations";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?Formation {
        $query = "SELECT * FROM formations WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $formationData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($formationData) {
            return new Formation(
                $formationData['id'],
                $formationData['title'],
                $formationData['description'],
                $formationData['startDate'],
                $formationData['endDate'],
                $formationData['typeId']
            );
        }

        return null;
    }

    public function create(Formation $formation): void {
        $query = "INSERT INTO formations (title, description, startDate, endDate, typeId)
                  VALUES (:title, :description, :startDate, :endDate, :typeId)";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':title' => $formation->getTitle(),
            ':description' => $formation->getDescription(),
            ':startDate' => $formation->getStartDate(),
            ':endDate' => $formation->getEndDate(),
            ':typeId' => $formation->getTypeId()
        ]);
    }

    public function update(Formation $formation): void {
        $query = "UPDATE formations SET title = :title, description = :description,
                  startDate = :startDate, endDate = :endDate, typeId = :typeId WHERE id = :id";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id' => $formation->getId(),
            ':title' => $formation->getTitle(),
            ':description' => $formation->getDescription(),
            ':startDate' => $formation->getStartDate(),
            ':endDate' => $formation->getEndDate(),
            ':typeId' => $formation->getTypeId()
        ]);
    }

    public function delete(int $id): void {
        $query = "DELETE FROM formations WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
    }
}

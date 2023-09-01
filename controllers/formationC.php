<?php
require_once '../../config.php';
require_once '../../entities/formation.php';

class FormationController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function getAll(): array {
        $query = "SELECT f.*,t.name FROM formations as f inner join types as t on f.typeId=t.id ";
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


    public function participate(int $idUser,int $idFormation): void {
        $query = "INSERT INTO participate (idUser, idFormation)
                  VALUES (:idUser, :idFormation)";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
    }
    
    public function removeParticipation(int $idUser, int $idFormation): void {
        $query = "DELETE FROM participate WHERE idUser = :idUser AND idFormation = :idFormation";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
    }
    public function favoris(int $idUser,int $idFormation): void {
        $query = "INSERT INTO favoris (idUser, idFormation)
                  VALUES (:idUser, :idFormation)";
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
    }

    public function removeFavoris(int $idUser, int $idFormation): void {
        $query = "DELETE FROM favoris WHERE idUser = :idUser AND idFormation = :idFormation";
    
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
    }

    public function isParticipating(int $idUser, int $idFormation): bool {
        $query = "SELECT COUNT(*) FROM participate WHERE idUser = :idUser AND idFormation = :idFormation";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function isFavoris(int $idUser, int $idFormation): bool {
        $query = "SELECT COUNT(*) FROM favoris WHERE idUser = :idUser AND idFormation = :idFormation";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':idUser' => $idUser,
            ':idFormation' => $idFormation
        ]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }


    public function getParticipatingFormations($idUser) {
        $sql = "SELECT formations.*,types.name FROM formations
                INNER JOIN participate ON formations.id = participate.idFormation INNER JOIN types ON formations.typeId=types.id
                WHERE participate.idUser = :idUser";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getWishlistFormations($idUser) {
        $sql = "SELECT formations.*,types.name FROM formations
                INNER JOIN favoris ON formations.id = favoris.idFormation INNER JOIN types ON formations.typeId=types.id
                WHERE favoris.idUser = :idUser";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormationsByTitle($title) {
        $sql = "SELECT formations.*,types.name FROM formations
                 INNER JOIN types ON formations.typeId=types.id
                WHERE formations.title LIKE '%$title%' ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

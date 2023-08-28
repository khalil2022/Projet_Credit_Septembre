<?php
require_once '../config.php';
require_once '../entities/user.php';

class UserController {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = config::getConnexion();
    }

    public function getAll(): array {
        $query = "SELECT * FROM users";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): ?User {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User($userData['id'], $userData['username'], $userData['password'], $userData['role']);
        }

        return null;
    }

    public function create(User $user): void {
        $query = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->pdo->prepare($query);
        
        // Hash the password before storing it
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        $stmt->execute([
            ':username' => $user->getUsername(),
            ':password' => $hashedPassword,
            ':role' => $user->getRole(),
        ]);
    }

    public function update(User $user): void {
        $query = "UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id' => $user->getId(),
            ':username' => $user->getUsername(),
            ':password' => $user->getPassword(),
            ':role' => $user->getRole(),
        ]);
    }

    public function delete(int $id): void {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
    }

    public function login(string $username, string $password): ?User {
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':username' => $username]);

        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData && password_verify($password, $userData['password'])) {
            return new User($userData['id'], $userData['username'], $userData['password'], $userData['role']);
        }

        return null;
    }
    
    // Additional methods as needed
}

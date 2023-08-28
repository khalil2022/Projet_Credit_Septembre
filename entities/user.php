<?php

class User {
  /* private ?int $id;
    private ?string $username;
    private ?string $password;
    private ?string $role; // 'admin', 'teacher', 'student'
    */
    public function __construct(
        private ?int $id = null,
        private ?string $username = null,
        private ?string $password = null,
        private ?string $role = null
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
    
    public function getId(): ?int {
        return $this->id;
    }

    public function getUsername(): ?string {
        return $this->username;
    }

    public function setUsername(?string $username): void {
        $this->username = $username;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function getRole(): ?string {
        return $this->role;
    }

    public function setRole(?string $role): void {
        $this->role = $role;
    }
}

<?php

class UserModel {
    private ?int $id = null;
    private string $username;
    private string $email;
    private string $password;

    private PDO $pdo;

    public function __construct(PDO $pdo, array $data = []) {
        $this->pdo = $pdo;

        // Hydrate the model if data is provided
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // Hydrate the model with data from an array
    public function hydrate(array $data): void {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Convert the model to an array
    public function toArray(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    // Getters and setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    // Database interactions

    public function save(): bool {
        if ($this->id === null) {
            // Insert new user
            $stmt = $this->pdo->prepare(
                "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)"
            );
            $success = $stmt->execute([
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password
            ]);

            if ($success) {
                $this->id = (int)$this->pdo->lastInsertId();
            }
            return $success;
        } else {
            // Update existing user
            $stmt = $this->pdo->prepare(
                "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id"
            );
            return $stmt->execute([
                ':id' => $this->id,
                ':username' => $this->username,
                ':email' => $this->email,
                ':password' => $this->password
            ]);
        }
    }

    public function delete(): bool {
        if ($this->id !== null) {
            $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
            return $stmt->execute([':id' => $this->id]);
        }
        return false;
    }

    public static function findById(PDO $pdo, int $id): ?self {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($pdo, $data) : null;
    }

    // Find a user by email
    public static function findByEmail(PDO $pdo, string $email): ?self {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ? new self($pdo, $data) : null;
    }

    public static function updatePassword($pdo, $id, $newPassword) {
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$newPassword, $id]);
    }

    public static function updateEmail($pdo, $id, $newEmail) {
        $stmt = $pdo->prepare("UPDATE users SET email = ? WHERE id = ?");
        $stmt->execute([$newEmail, $id]);
    }
    public static function updateName($pdo, $id, $newName) {
        $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->execute([$newName, $id]);
    }
}

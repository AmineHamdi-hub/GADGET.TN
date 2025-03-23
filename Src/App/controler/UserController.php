<?php
require 'App/model/UserModel.php';

class UserController {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Gérer l'affichage de la page d'enregistrement
    public function showRegisterForm(): void {
        include 'App/view/user/register.php';
    }

    // Gérer l'enregistrement d'un utilisateur
    public function register(string $username, string $email, string $password): void {
        $result = $this->registerLogic($username, $email, $password);
        include 'App/view/user/register_result.php';
    }

    private function registerLogic(string $username, string $email, string $password): array {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['success' => false, 'message' => 'Adresse email invalide.'];
        }

        $existingUser = UserModel::findByEmail($this->pdo, $email);
        if ($existingUser) {
            return ['success' => false, 'message' => 'L\'email est déjà utilisé.'];
        }

        $user = new UserModel($this->pdo);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword(password_hash($password, PASSWORD_BCRYPT));

        if ($user->save()) {
            return ['success' => true, 'message' => 'Inscription réussie.'];
        }

        return ['success' => false, 'message' => 'Erreur lors de l\'inscription.'];
    }

    public function showLoginForm(): void {
        include 'App/view/user/signin.php';
    }

    public function login(string $email, string $password): void {
        $result = $this->loginLogic($email, $password);
        include 'App/view/user/login_result.php';
    }

    private function loginLogic(string $email, string $password): array {
        $user = UserModel::findByEmail($this->pdo, $email);

        if ($user && password_verify($password, $user->getPassword())) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $_SESSION['user_id'] = $user->getId();
            $_SESSION['username'] = $user->getUsername();

            return ['success' => true, 'message' => 'Connexion réussie.'];
        }

        return ['success' => false, 'message' => 'Email ou mot de passe incorrect.'];
    }
    public function showUserProfile($id): void {
        $user = UserModel::findByID($this->pdo, $id);
        include 'App/view/user/profile.php';
    }
}


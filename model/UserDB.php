<?php
require_once __DIR__ . '/Database.php';

/**
 * User - Modèle qui gère tout ce qui touche aux utilisateurs
 */
class User {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // ─── INSCRIPTION ────────────────────────────────────────────
    public function inscrire(string $nom, string $email, string $password): bool {
        // Vérifier si l'email existe déjà
        if ($this->emailExiste($email)) {
            return false;
        }

        $sql = "INSERT INTO User (nom, email, mot_de_passe, role_u)
            VALUES (:nom, :email, :password, 'client')";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nom'      => $nom,
            ':email'    => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    // ─── CONNEXION ──────────────────────────────────────────────
    public function connecter(string $email, string $password): array|false {
        $sql  = "SELECT * FROM User WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        // Vérifier le mot de passe
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }

        return false;
    }

    // ─── UTILITAIRES ────────────────────────────────────────────
    public function emailExiste(string $email): bool {
        $stmt = $this->db->prepare("SELECT id FROM User WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch() !== false;
    }

    public function trouverParId(int $id): array|false {
        $stmt = $this->db->prepare("SELECT * FROM User WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
}

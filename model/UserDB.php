<?php
require_once("Database.php");

class UserDB extends Database {

    // INSCRIPTION
    public function register($nom, $email, $password, $role = 'client') {
        $sql = "INSERT INTO Utilisateur (nom, email, mot_de_passe, role) 
                VALUES (:nom, :email, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nom'      => $nom,
            ':email'    => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':role'     => $role
        ]);
    }

    // CONNEXION
    public function login($email, $password) {
        $sql = "SELECT * FROM Utilisateur WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Erreur login : " . $e->getMessage());
            return false;
        }
    }

    // VÉRIFIER SI EMAIL EXISTE
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM Utilisateur WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erreur emailExists : " . $e->getMessage());
            return false;
        }
    }

    // RÉCUPÉRER TOUS LES UTILISATEURS
    public function getAllUsers() {
        $sql = "SELECT id, nom, email, role FROM Utilisateur ORDER BY id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllUsers : " . $e->getMessage());
            return [];
        }
    }

    // SUPPRIMER UN UTILISATEUR
    public function deleteUser($id) {
        $sql = "DELETE FROM Utilisateur WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur deleteUser : " . $e->getMessage());
            return false;
        }
    }

    // RÉCUPÉRER LES PROPRIÉTAIRES (pour le dropdown)
    public function getProprietaires() {
        $sql = "SELECT id, nom FROM Utilisateur WHERE role = 'proprietaire' ORDER BY nom ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getProprietaires : " . $e->getMessage());
            return [];
        }
    }
    // RÉCUPÉRER UN UTILISATEUR PAR ID
    public function getUserById($id) {
        $sql = "SELECT id, nom, email, role FROM Utilisateur WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getUserById : " . $e->getMessage());
            return null;
        }
    }

}

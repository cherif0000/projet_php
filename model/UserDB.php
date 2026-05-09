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

        } catch (PDOException $error) {
            error_log("Erreur lors de la connexion : " . $error->getMessage());
            return false;
        }
    }

    // VÉRIFIER SI EMAIL EXISTE DÉJÀ
    public function emailExists($email) {
        $sql = "SELECT COUNT(*) FROM Utilisateur WHERE email = :email";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $error) {
            error_log("Erreur emailExists : " . $error->getMessage());
            return false;
        }
    }

}
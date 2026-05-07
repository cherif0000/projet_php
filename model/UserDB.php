<?php
require_once("Database.php");

class UserDB extends Database {

    // INSCRIPTION
    public function register($nom, $email, $password, $role = 'client') {
        $sql = "INSERT INTO Utilisateur (nom, email, mot_de_passe, role) 
                VALUES (:nom, :email, :password, :role)";
        
        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':nom' => $nom,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT),
            ':role' => $role
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
            error_log("Erreur lors de la connection " . $error->getMessage());
            return false;
        }
    }

}
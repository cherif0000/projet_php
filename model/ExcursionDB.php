<?php
require_once("Database.php");

class ExcursionDB extends Database {

    // TOUTES LES EXCURSIONS
    public function getAllExcursions() {
        $sql = "SELECT id, nom, adresse, date, prix, image FROM Excursion ORDER BY id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllExcursions : " . $e->getMessage());
            return [];
        }
    }


    // RÉCUPÉRER UNE EXCURSION PAR ID
    public function getExcursionById($id) {
        $sql = "SELECT id, nom, adresse, description, date, prix, image FROM Excursion WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getExcursionById : " . $e->getMessage());
            return null;
        }
    }

    // AJOUTER UNE EXCURSION
    public function addExcursion($nom, $adresse, $description, $date, $prix, $image) {
        $sql = "INSERT INTO Excursion (nom, adresse, description, date, prix, image)
                VALUES (:nom, :adresse, :description, :date, :prix, :image)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':nom'         => $nom,
                ':adresse'     => $adresse,
                ':description' => $description,
                ':date'        => $date,
                ':prix'        => $prix,
                ':image'       => $image
            ]);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            error_log("Erreur addExcursion : " . $e->getMessage());
            return false;
        }
    }

    // SUPPRIMER UNE EXCURSION
    public function deleteExcursion($id) {
        $sql = "DELETE FROM Excursion WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur deleteExcursion : " . $e->getMessage());
            return false;
        }
    }
}

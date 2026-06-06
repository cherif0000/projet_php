<?php
require_once("Database.php");

class AvisDB extends Database {

    // TOUS LES AVIS avec client + logement
    public function getAllAvis() {
        $sql = "SELECT a.id, a.commentaire, a.note, a.date,
                       u.nom AS client,
                       l.titre AS logement
                FROM Avis a
                JOIN Utilisateur u ON a.user_id = u.id
                JOIN Logement l    ON a.logement_id = l.id
                ORDER BY a.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllAvis : " . $e->getMessage());
            return [];
        }
    }

    // SUPPRIMER UN AVIS (modération)
    public function deleteAvis($id) {
        $sql = "DELETE FROM Avis WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur deleteAvis : " . $e->getMessage());
            return false;
        }
    }
}

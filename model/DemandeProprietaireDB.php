<?php
require_once("Database.php");

class DemandeProprietaireDB extends Database {


    // SOUMETTRE UNE DEMANDE
    public function addDemande($user_id, $description, $preuve = null) {
        // PDO n'accepte pas les paramètres nommés en double → on utilise VALUES() dans ON DUPLICATE KEY
        $sql = "INSERT INTO DemandeProprietaire (user_id, description, preuve, statut, date)
                VALUES (:user_id, :description, :preuve, 'en_attente', CURDATE())
                ON DUPLICATE KEY UPDATE
                    description = VALUES(description),
                    preuve      = VALUES(preuve),
                    statut      = 'en_attente',
                    date        = CURDATE()";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':user_id'     => (int)$user_id,
                ':description' => $description,
                ':preuve'      => $preuve
            ]);
        } catch (PDOException $e) {
            error_log("Erreur addDemande : " . $e->getMessage());
            return false;
        }
    }

    // RÉCUPÉRER LA DEMANDE D'UN UTILISATEUR
    public function getDemandeByUser($user_id) {
        $sql = "SELECT * FROM DemandeProprietaire WHERE user_id = :user_id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':user_id' => (int)$user_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getDemandeByUser : " . $e->getMessage());
            return null;
        }
    }

    // MÉTHODE SQL GÉNÉRIQUE (pour execSQL dans controller)
    public function execSQL($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Erreur execSQL : " . $e->getMessage());
            return false;
        }
    }

    // TOUTES LES DEMANDES avec nom + email du demandeur
    public function getAllDemandes() {
        $sql = "SELECT d.id, d.statut, d.date, d.description, d.preuve,
                       u.id AS user_id, u.nom, u.email
                FROM DemandeProprietaire d
                JOIN Utilisateur u ON d.user_id = u.id
                ORDER BY d.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllDemandes : " . $e->getMessage());
            return [];
        }
    }

    // CHANGER STATUT d'une demande
    public function updateStatut($id, $statut) {
        $sql = "UPDATE DemandeProprietaire SET statut = :statut WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':statut' => $statut, ':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur updateStatut demande : " . $e->getMessage());
            return false;
        }
    }

    // RÉCUPÉRER user_id d'une demande
    public function getUserId($id) {
        $sql = "SELECT user_id FROM DemandeProprietaire WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => (int)$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row['user_id'] : null;
        } catch (PDOException $e) {
            error_log("Erreur getUserId demande : " . $e->getMessage());
            return null;
        }
    }
}

<?php
require_once("Database.php");

class ReservationLogementDB extends Database {


    // AJOUTER UNE RÉSERVATION LOGEMENT
    public function addReservation($user_id, $logement_id, $date_debut, $date_fin) {
        $sql = "INSERT INTO ReservationLogement (user_id, logement_id, date_debut, date_fin, statut)
                VALUES (:user_id, :logement_id, :date_debut, :date_fin, 'en_attente')";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':user_id'     => (int)$user_id,
                ':logement_id' => (int)$logement_id,
                ':date_debut'  => $date_debut,
                ':date_fin'    => $date_fin
            ]);
        } catch (PDOException $e) {
            error_log("Erreur addReservation logement : " . $e->getMessage());
            return false;
        }
    }

    // TOUTES LES RÉSERVATIONS avec client + logement
    public function getAllReservations() {
        $sql = "SELECT r.id, r.date_debut, r.date_fin, r.statut,
                       u.nom AS client,
                       l.titre AS logement
                FROM ReservationLogement r
                JOIN Utilisateur u ON r.user_id = u.id
                JOIN Logement l    ON r.logement_id = l.id
                ORDER BY r.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllReservations logement : " . $e->getMessage());
            return [];
        }
    }

    // RÉSERVATIONS DES LOGEMENTS D'UN PROPRIÉTAIRE
        public function getReservationsByProprietaire($user_id) {
            $sql = "SELECT r.id, r.date_debut, r.date_fin, r.statut,
                        u.nom AS client,
                        l.titre AS logement
                    FROM ReservationLogement r
                    JOIN Utilisateur u ON r.user_id = u.id
                    JOIN Logement l    ON r.logement_id = l.id
                    WHERE l.user_id = :user_id
                    ORDER BY r.id ASC";
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':user_id' => (int)$user_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Erreur getReservationsByProprietaire : " . $e->getMessage());
                return [];
            }
        }

    // METTRE À JOUR LE STATUT
    public function updateStatut($id, $statut) {
        $sql = "UPDATE ReservationLogement SET statut = :statut WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':statut' => $statut, ':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur updateStatut réservation logement : " . $e->getMessage());
            return false;
        }
    }
}

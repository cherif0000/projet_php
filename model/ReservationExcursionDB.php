<?php
require_once("Database.php");

class ReservationExcursionDB extends Database {


    // AJOUTER UNE RÉSERVATION EXCURSION
    public function addReservation($user_id, $excursion_id, $nombre_personne, $date_reservation, $montant) {
        $sql = "INSERT INTO ReservationExcursion (user_id, excursion_id, nombre_personne, date_reservation, montant)
                VALUES (:user_id, :excursion_id, :nombre_personne, :date_reservation, :montant)";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':user_id'          => (int)$user_id,
                ':excursion_id'     => (int)$excursion_id,
                ':nombre_personne'  => (int)$nombre_personne,
                ':date_reservation' => $date_reservation,
                ':montant'          => (float)$montant
            ]);
        } catch (PDOException $e) {
            error_log("Erreur addReservation excursion : " . $e->getMessage());
            return false;
        }
    }

    // TOUTES LES RÉSERVATIONS avec client + excursion
    public function getAllReservations() {
        $sql = "SELECT r.id, r.date_reservation, r.nombre_personne, r.montant,
                       u.nom AS client,
                       e.nom AS excursion
                FROM ReservationExcursion r
                JOIN Utilisateur u ON r.user_id = u.id
                JOIN Excursion e   ON r.excursion_id = e.id
                ORDER BY r.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllReservations excursion : " . $e->getMessage());
            return [];
        }
    }
}

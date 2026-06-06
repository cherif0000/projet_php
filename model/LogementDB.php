<?php
require_once("Database.php");

class LogementDB extends Database {

    // RÉCUPÉRER TOUS LES LOGEMENTS (avec nom du propriétaire)
    public function getAllLogements() {
        $sql = "SELECT l.id, l.titre, l.adresse, l.prix, l.statut, u.nom AS proprietaire
                FROM Logement l
                JOIN Utilisateur u ON l.user_id = u.id
                ORDER BY l.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllLogements : " . $e->getMessage());
            return [];
        }
    }


    // RÉCUPÉRER UN LOGEMENT PAR ID
    public function getLogementById($id) {
        $sql = "SELECT l.id, l.titre, l.adresse, l.description, l.prix, l.statut,
                       u.nom AS proprietaire
                FROM Logement l
                JOIN Utilisateur u ON l.user_id = u.id
                WHERE l.id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => (int)$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getLogementById : " . $e->getMessage());
            return null;
        }
    }

    // RÉCUPÉRER LES IMAGES D'UN LOGEMENT
    public function getImagesLogement($logement_id) {
        $sql = "SELECT url_image FROM ImgLogement WHERE logement_id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id' => (int)$logement_id]);
            return $stmt->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            error_log("Erreur getImagesLogement : " . $e->getMessage());
            return [];
        }
    }

    // TOUS LES LOGEMENTS AVEC 1ère IMAGE
    public function getAllLogementsWithImage() {
        $sql = "SELECT l.id, l.titre, l.adresse, l.prix, l.statut,
                       u.nom AS proprietaire,
                       (SELECT i.url_image FROM ImgLogement i WHERE i.logement_id = l.id LIMIT 1) AS image
                FROM Logement l
                JOIN Utilisateur u ON l.user_id = u.id
                ORDER BY l.id ASC";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur getAllLogementsWithImage : " . $e->getMessage());
            return [];
        }
    }

    // AJOUTER UN LOGEMENT
    public function addLogement($titre, $adresse, $description, $prix, $statut, $user_id) {
        $sql = "INSERT INTO Logement (titre, adresse, description, prix, statut, user_id)
                VALUES (:titre, :adresse, :description, :prix, :statut, :user_id)";
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':titre'       => $titre,
                ':adresse'     => $adresse,
                ':description' => $description,
                ':prix'        => $prix,
                ':statut'      => $statut,
                ':user_id'     => (int)$user_id
            ]);
            return $this->pdo->lastInsertId(); // retourne le nouvel ID
        } catch (PDOException $e) {
            error_log("Erreur addLogement : " . $e->getMessage());
            return false;
        }
    }

    // AJOUTER UNE IMAGE LIÉE À UN LOGEMENT
    public function addImage($url_image, $logement_id) {
        $sql = "INSERT INTO ImgLogement (url_image, logement_id) VALUES (:url, :logement_id)";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':url' => $url_image, ':logement_id' => (int)$logement_id]);
        } catch (PDOException $e) {
            error_log("Erreur addImage : " . $e->getMessage());
            return false;
        }
    }
    
    // LOGEMENTS D'UN PROPRIÉTAIRE SPÉCIFIQUE
        public function getLogementsByProprietaire($user_id) {
            $sql = "SELECT l.id, l.titre, l.adresse, l.prix, l.statut,
                        u.nom AS proprietaire,
                        (SELECT i.url_image FROM ImgLogement i WHERE i.logement_id = l.id LIMIT 1) AS image
                    FROM Logement l
                    JOIN Utilisateur u ON l.user_id = u.id
                    WHERE l.user_id = :user_id
                    ORDER BY l.id ASC";
            try {
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([':user_id' => (int)$user_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Erreur getLogementsByProprietaire : " . $e->getMessage());
                return [];
            }
        }

    // MODIFIER UN LOGEMENT
    public function updateLogement($id, $titre, $adresse, $description, $prix, $statut) {
        $sql = "UPDATE Logement SET titre=:titre, adresse=:adresse, description=:description,
                prix=:prix, statut=:statut WHERE id=:id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':id'          => (int)$id,
                ':titre'       => $titre,
                ':adresse'     => $adresse,
                ':description' => $description,
                ':prix'        => (float)$prix,
                ':statut'      => $statut
            ]);
        } catch (PDOException $e) {
            error_log("Erreur updateLogement : " . $e->getMessage());
            return false;
        }
    }

    // SUPPRIMER UN LOGEMENT
    public function deleteLogement($id) {
        $sql = "DELETE FROM Logement WHERE id = :id";
        try {
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([':id' => (int)$id]);
        } catch (PDOException $e) {
            error_log("Erreur deleteLogement : " . $e->getMessage());
            return false;
        }
    }
}

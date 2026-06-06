<?php
session_start();
require_once("../model/DemandeProprietaireDB.php");
require_once("../model/UserDB.php");

$demandeDB = new DemandeProprietaireDB();
$userDB    = new UserDB();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    if ($_GET['action'] === 'approuver') {
        $user_id = $demandeDB->getUserId($id);
        // Met à jour le statut de la demande
        $demandeDB->updateStatut($id, 'acceptee');
        // Passe l'utilisateur en rôle propriétaire
        if ($user_id) {
            $sql = "UPDATE Utilisateur SET role = 'proprietaire' WHERE id = :id";
            $db = new DemandeProprietaireDB();
            $db->execSQL($sql, [':id' => $user_id]);
        }
        header("Location: demande?Success=1&message=" . urlencode("Demande approuvée, l'utilisateur est maintenant propriétaire.") . "&title=" . urlencode("Approuvée"));

    } elseif ($_GET['action'] === 'refuser') {
        $demandeDB->updateStatut($id, 'refusee');
        header("Location: demande?Success=1&message=" . urlencode("Demande refusée.") . "&title=" . urlencode("Refusée"));

    } else {
        header("Location: demande?error=1&message=" . urlencode("Action inconnue.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

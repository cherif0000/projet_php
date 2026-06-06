<?php
session_start();
require_once("../model/ReservationLogementDB.php");

$reservationDB = new ReservationLogementDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btnEditRL'])) {
    $id     = (int)($_POST['id']     ?? 0);
    $statut = trim($_POST['statut']  ?? '');

    $allowed = ['en_attente', 'confirmee', 'annulee'];
    if ($id > 0 && in_array($statut, $allowed) && $reservationDB->updateStatut($id, $statut)) {
        header("Location: reservationLogement?Success=1&message=" . urlencode("Statut mis à jour.") . "&title=" . urlencode("Mise à jour réussie"));
    } else {
        header("Location: reservationLogement?error=1&message=" . urlencode("Impossible de mettre à jour le statut.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

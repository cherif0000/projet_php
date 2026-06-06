<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit;
}

require_once("../model/ReservationLogementDB.php");
require_once("../model/ReservationExcursionDB.php");

$action = $_GET['action'] ?? '';

// ─────────────────────────────────────────────
// RÉSERVER UN LOGEMENT
// ─────────────────────────────────────────────
if ($action === 'reserverLogement' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $logement_id = (int)($_POST['logement_id'] ?? 0);
    $date_debut  = trim($_POST['date_debut']  ?? '');
    $date_fin    = trim($_POST['date_fin']    ?? '');
    $user_id     = (int)$_SESSION['id'];

    if ($logement_id > 0 && $date_debut && $date_fin && $date_fin > $date_debut) {
        $db = new ReservationLogementDB();
        $ok = $db->addReservation($user_id, $logement_id, $date_debut, $date_fin);
        if ($ok) {
            header("Location: logementDetail?id=$logement_id&Success=1&title=" . urlencode("Réservation envoyée") . "&message=" . urlencode("Votre demande est en attente de confirmation."));
        } else {
            header("Location: logementDetail?id=$logement_id&error=1&message=" . urlencode("Erreur lors de la réservation."));
        }
    } else {
        header("Location: logementDetail?id=$logement_id&error=1&message=" . urlencode("Veuillez remplir correctement les dates."));
    }
    exit;
}

// ─────────────────────────────────────────────
// RÉSERVER UNE EXCURSION
// ─────────────────────────────────────────────
if ($action === 'reserverExcursion' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $excursion_id    = (int)($_POST['excursion_id']    ?? 0);
    $nombre_personne = (int)($_POST['nombre_personne'] ?? 0);
    $date_reservation = trim($_POST['date_reservation'] ?? '');
    $prix_unitaire   = (float)($_POST['prix_unitaire'] ?? 0);
    $user_id         = (int)$_SESSION['id'];
    $montant         = $nombre_personne * $prix_unitaire;

    if ($excursion_id > 0 && $nombre_personne > 0 && $date_reservation) {
        $db = new ReservationExcursionDB();
        $ok = $db->addReservation($user_id, $excursion_id, $nombre_personne, $date_reservation, $montant);
        if ($ok) {
            header("Location: excursionDetail?id=$excursion_id&Success=1&title=" . urlencode("Réservation confirmée") . "&message=" . urlencode("Votre excursion a été réservée pour $nombre_personne personne(s)."));
        } else {
            header("Location: excursionDetail?id=$excursion_id&error=1&message=" . urlencode("Erreur lors de la réservation."));
        }
    } else {
        header("Location: excursionDetail?id=$excursion_id&error=1&message=" . urlencode("Veuillez remplir tous les champs."));
    }
    exit;
}

header("Location: dashboard");
exit;

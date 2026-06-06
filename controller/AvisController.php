<?php
session_start();
require_once("../model/AvisDB.php");

$avisDB = new AvisDB();

if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0 && $avisDB->deleteAvis($id)) {
        header("Location: avis?Success=1&message=" . urlencode("Avis supprimé.") . "&title=" . urlencode("Suppression réussie"));
    } else {
        header("Location: avis?error=1&message=" . urlencode("Impossible de supprimer cet avis.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

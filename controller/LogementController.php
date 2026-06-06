<?php
session_start();
require_once("../model/LogementDB.php");
require_once("../model/UserDB.php");

$logementDB = new LogementDB();

// ── SUPPRESSION ──────────────────────────────────────────────────────────────
if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id > 0 && $logementDB->deleteLogement($id)) {
        header("Location: logement?Success=1&message=" . urlencode("Logement supprimé avec succès.") . "&title=" . urlencode("Suppression réussie"));
    } else {
        header("Location: logement?error=1&message=" . urlencode("Impossible de supprimer ce logement.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}


// ── MODIFICATION ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $id          = (int)($_POST['id']          ?? 0);
    $titre       = trim($_POST['titre']        ?? '');
    $adresse     = trim($_POST['adresse']      ?? '');
    $description = trim($_POST['description']  ?? '');
    $prix        = floatval($_POST['prix']     ?? 0);
    $statut      = $_POST['statut']            ?? 'disponible';

    if ($id <= 0 || empty($titre) || empty($adresse) || empty($description) || $prix <= 0) {
        header("Location: logement?error=1&message=" . urlencode("Veuillez remplir tous les champs.") . "&title=" . urlencode("Erreur de validation"));
        exit;
    }

    if ($logementDB->updateLogement($id, $titre, $adresse, $description, $prix, $statut)) {
        header("Location: logement?Success=1&message=" . urlencode("Logement modifié avec succès.") . "&title=" . urlencode("Modification réussie"));
    } else {
        header("Location: logement?error=1&message=" . urlencode("Erreur lors de la modification.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

// ── AJOUT ────────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {

    $titre       = trim($_POST['titre']       ?? '');
    $adresse     = trim($_POST['adresse']     ?? '');
    $description = trim($_POST['description'] ?? '');
    $prix        = floatval($_POST['prix']    ?? 0);
    $statut      = $_POST['statut']           ?? 'disponible';
    $user_id     = (int)($_POST['user_id']    ?? 0);

    // Validation basique
    if (empty($titre) || empty($adresse) || empty($description) || $prix <= 0 || $user_id <= 0) {
        header("Location: logement?error=1&message=" . urlencode("Veuillez remplir tous les champs correctement.") . "&title=" . urlencode("Erreur de validation"));
        exit;
    }

    // Insertion du logement
    $logement_id = $logementDB->addLogement($titre, $adresse, $description, $prix, $statut, $user_id);

    if (!$logement_id) {
        header("Location: logement?error=1&message=" . urlencode("Erreur lors de l'ajout du logement.") . "&title=" . urlencode("Erreur"));
        exit;
    }

    // Gestion des images (si fournies)
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = __DIR__ . '/../public/uploads/logements/';

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        foreach ($_FILES['images']['tmp_name'] as $i => $tmpName) {
            if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) continue;

            $mimeType = mime_content_type($tmpName);
            if (!in_array($mimeType, $allowedTypes)) continue;

            $extension = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
            $fileName  = 'logement_' . $logement_id . '_' . uniqid() . '.' . $extension;
            $destPath  = $uploadDir . $fileName;

            if (move_uploaded_file($tmpName, $destPath)) {
                // Stocker le chemin relatif accessible depuis le web
                $logementDB->addImage('public/uploads/logements/' . $fileName, $logement_id);
            }
        }
    }

    header("Location: logement?Success=1&message=" . urlencode("Logement ajouté avec succès.") . "&title=" . urlencode("Ajout réussi"));
    exit;
}

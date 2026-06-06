<?php
session_start();
require_once("../model/ExcursionDB.php");

$excursionDB = new ExcursionDB();

// ── SUPPRESSION ──────────────────────────────────────────────────────────────
if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    $id = (int)($_GET['id'] ?? 0);
    if ($id > 0 && $excursionDB->deleteExcursion($id)) {
        header("Location: excursion?Success=1&message=" . urlencode("Excursion supprimée.") . "&title=" . urlencode("Suppression réussie"));
    } else {
        header("Location: excursion?error=1&message=" . urlencode("Impossible de supprimer cette excursion.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

// ── AJOUT ────────────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $nom         = trim($_POST['nom']         ?? '');
    $adresse     = trim($_POST['adresse']     ?? '');
    $description = trim($_POST['description'] ?? '');
    $date        = $_POST['date']             ?? '';
    $prix        = floatval($_POST['prix']    ?? 0);

    if (empty($nom) || empty($adresse) || empty($description) || empty($date) || $prix <= 0) {
        header("Location: excursion?error=1&message=" . urlencode("Veuillez remplir tous les champs.") . "&title=" . urlencode("Erreur de validation"));
        exit;
    }

    // Gestion image
    $imagePath = null;
    if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../public/uploads/excursions/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $mimeType = mime_content_type($_FILES['image']['tmp_name']);
        if (in_array($mimeType, $allowedTypes)) {
            $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName  = 'excursion_' . uniqid() . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                $imagePath = 'public/uploads/excursions/' . $fileName;
            }
        }
    }

    if ($excursionDB->addExcursion($nom, $adresse, $description, $date, $prix, $imagePath)) {
        header("Location: excursion?Success=1&message=" . urlencode("Excursion ajoutée avec succès.") . "&title=" . urlencode("Ajout réussi"));
    } else {
        header("Location: excursion?error=1&message=" . urlencode("Erreur lors de l'ajout.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}

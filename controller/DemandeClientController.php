<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit;
}

require_once("../model/DemandeProprietaireDB.php");

$demandeDB = new DemandeProprietaireDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? $_GET['action'] ?? '') === 'soumettre') {
    $description = trim($_POST['description'] ?? '');
    $user_id     = (int)$_SESSION['id'];
    $preuve      = null;

    if (empty($description)) {
        header("Location: dashboard?demande_error=1&demande_msg=" . urlencode("Veuillez décrire votre bien."));
        exit;
    }

    // Gestion upload photo preuve
    if (isset($_FILES['preuve']) && $_FILES['preuve']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB

        if (!in_array($_FILES['preuve']['type'], $allowed)) {
            header("Location: dashboard?demande_error=1&demande_msg=" . urlencode("Format invalide. JPG, PNG ou WEBP uniquement."));
            exit;
        }
        if ($_FILES['preuve']['size'] > $maxSize) {
            header("Location: dashboard?demande_error=1&demande_msg=" . urlencode("Image trop lourde (max 5MB)."));
            exit;
        }

        $ext      = pathinfo($_FILES['preuve']['name'], PATHINFO_EXTENSION);
        $filename = 'preuve_' . $user_id . '_' . time() . '.' . $ext;
        $dest     = "../public/uploads/preuves/" . $filename;

        if (move_uploaded_file($_FILES['preuve']['tmp_name'], $dest)) {
            $preuve = "public/uploads/preuves/" . $filename;
        }
    }

    if ($demandeDB->addDemande($user_id, $description, $preuve)) {
        header("Location: dashboard?demande_ok=1");
    } else {
        header("Location: dashboard?demande_error=1&demande_msg=" . urlencode("Erreur lors de l'envoi. Réessayez."));
    }
    exit;
}

header("Location: dashboard");
exit;

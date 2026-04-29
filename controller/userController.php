<?php
session_start();

require_once __DIR__ . '/../model/User.php';

$userModel = new User();

// ─── CONNEXION ──────────────────────────────────────────────────
if (isset($_POST['btnLogin'])) {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $_SESSION['message']      = "Veuillez remplir tous les champs.";
        $_SESSION['message_type'] = "warning";
        header('Location: ../login.php');
        exit;
    }

    $user = $userModel->connecter($email, $password);

    if ($user) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_nom']  = $user['nom'];
        $_SESSION['user_role'] = $user['role_u']; // ✅ Corrigé : role_u

        $_SESSION['message']      = "Bienvenue, " . $user['nom'] . " !";
        $_SESSION['message_type'] = "success";

        switch ($user['role_u']) { // ✅ Corrigé : role_u
            case 'admin':
                header('Location: ../admin.php');
                break;
            case 'proprietaire':
                header('Location: ../view/pages/dashboard.php');
                break;
            default:
                header('Location: ../view/pages/dashboard.php');
        }
        exit;

    } else {
        $_SESSION['message']      = "Email ou mot de passe incorrect.";
        $_SESSION['message_type'] = "error";
        header('Location: ../login.php');
        exit;
    }
}

// ─── INSCRIPTION ────────────────────────────────────────────────
if (isset($_POST['btnRegister'])) {
    $prenom   = trim($_POST['prenom'] ?? '');
    $nom      = trim($_POST['nom'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (empty($prenom) || empty($nom) || empty($email) || empty($password)) {
        $_SESSION['message']      = "Veuillez remplir tous les champs.";
        $_SESSION['message_type'] = "warning";
        header('Location: ../inscription.php');
        exit;
    }

    if ($password !== $confirm) {
        $_SESSION['message']      = "Les mots de passe ne correspondent pas.";
        $_SESSION['message_type'] = "error";
        header('Location: ../inscription.php');
        exit;
    }

    if (strlen($password) < 6) {
        $_SESSION['message']      = "Le mot de passe doit contenir au moins 6 caractères.";
        $_SESSION['message_type'] = "warning";
        header('Location: ../inscription.php');
        exit;
    }

    $nomComplet = $prenom . ' ' . $nom;
    $success    = $userModel->inscrire($nomComplet, $email, $password);

    if ($success) {
        $_SESSION['message']      = "Compte créé avec succès ! Vous pouvez vous connecter.";
        $_SESSION['message_type'] = "success";
        header('Location: ../login.php');
    } else {
        $_SESSION['message']      = "Cet email est déjà utilisé.";
        $_SESSION['message_type'] = "error";
        header('Location: ../inscription.php');
    }
    exit;
}

// ─── DÉCONNEXION ────────────────────────────────────────────────
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../index.php');
    exit;
}

// Si on arrive ici sans POST ni GET → rediriger
header('Location: ../index.php');
exit;

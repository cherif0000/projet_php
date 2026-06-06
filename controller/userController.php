<?php
session_start();
 
// ───────────────────────────────────────────────────
// Déconnexion
// ───────────────────────────────────────────────────
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    session_destroy();
    header("Location: login");
    exit;
}
 
require_once("../model/UserDB.php");
 
$userDB = new UserDB();
 
// ───────────────────────────────────────────────────
// Helpers
// ───────────────────────────────────────────────────
 
function validateLoginFields($email, $password) {
    if (empty($email) || empty($password)) {
        return "Veuillez remplir tous les champs.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Veuillez entrer une adresse email valide.";
    }
    return null;
}
 
function validateRegisterFields($nom, $email, $password, $confirmPassword) {
    if (empty($nom) || empty($email) || empty($password) || empty($confirmPassword)) {
        return "Veuillez remplir tous les champs.";
    }
    if (strlen($nom) < 3) {
        return "Le nom doit contenir au moins 3 caractères.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Veuillez entrer une adresse email valide.";
    }
    if (strlen($password) < 8) {
        return "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if ($password !== $confirmPassword) {
        return "Les mots de passe ne correspondent pas.";
    }
    return null;
}
 
function setErrorAndRedirect($message, $title, $redirectUrl = "login") {
    $_SESSION['error'] = $message;
    header("Location: $redirectUrl?error=1&message=" . urlencode($message) . "&title=" . urlencode($title));
    exit();
}
 
// ───────────────────────────────────────────────────
// Super Admin
// ───────────────────────────────────────────────────
 
function authSuperAdmin($email, $password) {
    if ($email === "admin@gmail.com" && $password === "passer123") {
        $_SESSION['id']    = 1;
        $_SESSION['nom']   = "cherif abdeldjelil";
        $_SESSION['email'] = $email;
        $_SESSION['role']  = 'superadmin'; // ← rôle superadmin
        header("Location: admin?Success=1&message=" . urlencode("Connexion réussie.") . "&title=" . urlencode("Connexion réussie."));
        exit;
    }
}
 
// ───────────────────────────────────────────────────
// Admin login
// ───────────────────────────────────────────────────
 
function authAdmin($email, $password, $userDB) {
    $user = $userDB->login($email, $password);
 
    if ($user) {
        $_SESSION['id']    = $user['id'];
        $_SESSION['nom']   = $user['nom'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role']  = $user['role'];
 
        if (isset($_POST['remember'])) {
            setcookie("remenber_me", $user['id'], time() + (86400 * 30), "/", "", false, true);
        }
 
        // Redirection selon le rôle
        if ($user['role'] === 'proprietaire') {
            header("Location: admin?Success=1&message=" . urlencode("Connexion réussie.") . "&title=" . urlencode("Connexion réussie."));
        } else {
            header("Location: dashboard?Success=1&message=" . urlencode("Connexion réussie.") . "&title=" . urlencode("Connexion réussie."));
        }
        exit;
    }
 
    return false;
}
 
// ───────────────────────────────────────────────────
// Inscription
// ───────────────────────────────────────────────────
 
function registerUser($nom, $email, $password, $userDB) {
    if ($userDB->emailExists($email)) {
        setErrorAndRedirect("Cette adresse email est déjà utilisée.", "Email déjà existant", "inscription");
    }
    if ($userDB->register($nom, $email, $password)) {
        header("Location: inscription?Success=1&message=" . urlencode("Votre compte a été créé avec succès.") . "&title=" . urlencode("Inscription réussie !"));
        exit;
    }
    setErrorAndRedirect("Une erreur est survenue lors de l'inscription. Veuillez réessayer.", "Erreur", "inscription");
}
 
// ───────────────────────────────────────────────────
// Suppression utilisateur
// ───────────────────────────────────────────────────
 
if (isset($_GET['action']) && $_GET['action'] === 'supprimer') {
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
 
    if ($id > 0 && $userDB->deleteUser($id)) {
        header("Location: utilisateur?Success=1&message=" . urlencode("Utilisateur supprimé avec succès.") . "&title=" . urlencode("Suppression réussie"));
    } else {
        header("Location: utilisateur?error=1&message=" . urlencode("Impossible de supprimer cet utilisateur.") . "&title=" . urlencode("Erreur"));
    }
    exit;
}
 
// ───────────────────────────────────────────────────
// Traitement des formulaires POST
// ───────────────────────────────────────────────────
 
if ($_SERVER['REQUEST_METHOD'] === "POST") {
 
    // Connexion
    if (isset($_POST['frmLogin'])) {
        $email    = trim($_POST['email']    ?? '');
        $password = trim($_POST['password'] ?? '');
 
        $messageError = validateLoginFields($email, $password);
        if ($messageError) {
            setErrorAndRedirect($messageError, "Erreur de validation");
        }
 
        authSuperAdmin($email, $password);
 
        if (!authAdmin($email, $password, $userDB)) {
            setErrorAndRedirect("Email ou mot de passe incorrect.", "Erreur d'authentification");
        }
    }
 
    // Inscription
    if (isset($_POST['frmRegister'])) {
        $nom             = trim($_POST['nom']             ?? '');
        $email           = trim($_POST['email']           ?? '');
        $password        = trim($_POST['password']        ?? '');
        $confirmPassword = trim($_POST['confirmPassword'] ?? '');
 
        $messageError = validateRegisterFields($nom, $email, $password, $confirmPassword);
        if ($messageError) {
            setErrorAndRedirect($messageError, "Erreur de validation", "inscription");
        }
 
        registerUser($nom, $email, $password, $userDB);
    }
}
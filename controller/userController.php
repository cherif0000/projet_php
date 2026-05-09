<?php
session_start();
require_once("../model/UserDB.php");

$userDB = new UserDB();

// permet de valider l'email et le mot de passe

function validateLoginFields($email, $password) {

    if (empty($email) || empty($password)) {
        return "Veuillez remplir tous les champs.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Veuillez entrer une adresse email valide.";
    }

    return null;
}

// permet de valider les champs d'inscription

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

// permet de faire la gestion d'erreurs 

function setErrorAndRedirect($message, $title, $redirectUrl = "login") {
    $_SESSION['error'] = $message;
    header("Location: $redirectUrl?error=1&message=" . urlencode($message). "&title=" . urlencode($title));
    exit();
}

// permet d'itentifier un super administrateur

function authSuperAdmin($email, $password) {
    if ($email === "admin@gmail.com" && $password === "passer123") {
        $_SESSION['id'] = 1; 
        $_SESSION['nom'] = "cherif abdeldjelil";
        $_SESSION['email'] = $email;

        header("Location: admin?Success=1&message=" . urlencode("Connexion réussie."). "&title=" . urlencode("Connexion réussie."));
        exit;

}
}

// permet d'itentifier un administrateur

function authAdmin($email, $password,$userDB) {
    $user = $userDB->login($email, $password);

    if ($user) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['email'] = $user['email'];

       if (ISSET($_POST['remember'])) {
            setcookie("remenber_me", $user['id'], time() + (86400 * 30), "/", "", false, true);
        }

        header("Location: dashboard?Success=1&message=" . urlencode("Connexion réussie."). "&title=" . urlencode("Connexion réussie."));
        exit;

    }

    return false;
}

// permet d'inscrire un nouvel utilisateur

function registerUser($nom, $email, $password, $userDB) {

    if ($userDB->emailExists($email)) {
        setErrorAndRedirect("Cette adresse email est déjà utilisée.", "Email déjà existant", "inscription");
    }

    if ($userDB->register($nom, $email, $password)) {
        header("Location: inscription?Success=1&message=" . urlencode("Votre compte a été créé avec succès."). "&title=" . urlencode("Inscription réussie !"));
        exit;
    }

    setErrorAndRedirect("Une erreur est survenue lors de l'inscription. Veuillez réessayer.", "Erreur", "inscription");
}

 if ($_SERVER['REQUEST_METHOD']== "POST") {

    // traitement du formulaire de connexion

    if (isset($_POST['frmLogin'])) {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

       // validation des champs

       $messageError = validateLoginFields($email, $password);

        if ($messageError) {
            setErrorAndRedirect($messageError, "Erreur de validation");
        }

        // authentification super admin

        if (authSuperAdmin($email, $password)) {
            exit;
        }

        // authentification admin via login

        if (!authAdmin($email, $password,$userDB)) {
            setErrorAndRedirect("Email ou mot de passe incorrect.", "Erreur d'authentification");
        }
    }

    // traitement du formulaire d'inscription

    if (isset($_POST['frmRegister'])) {
        $nom             = trim($_POST['nom']             ?? '');
        $email           = trim($_POST['email']           ?? '');
        $password        = trim($_POST['password']        ?? '');
        $confirmPassword = trim($_POST['confirmPassword'] ?? '');

        // validation des champs

        $messageError = validateRegisterFields($nom, $email, $password, $confirmPassword);

        if ($messageError) {
            setErrorAndRedirect($messageError, "Erreur de validation", "inscription");
        }

        // inscription de l'utilisateur

        registerUser($nom, $email, $password, $userDB);
    }
 }

?>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr" class="<?= isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark' ? 'dark' : '' ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - DakarStay</title>
    <meta name="description" content="Connectez-vous à votre compte DakarStay.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=DM+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body class="animate-fade-in">

    <div class="form-container animate-scale-in" style="max-width: 450px;">
        <div class="form-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <h1 class="form-title">Connexion</h1>
        <p class="form-subtitle">Accédez à votre espace personnel DakarStay</p>

        <form method="POST" action="controller/UserController.php">
            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-input" id="email" placeholder="exemple@email.com" required>
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-input" id="password" placeholder="Votre mot de passe"
                    required>
            </div>

            <!-- Se souvenir de moi -->
            <div class="form-checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit" name="btnLogin" class="form-submit">
                <i class="fas fa-sign-in-alt"></i> Se connecter
            </button>
        </form>

        <div class="form-footer" style="margin-top: 1.5rem;">
            <a href="#" style="color: var(--muted-foreground); font-size: 0.875rem;">Mot de passe oublié ?</a>
        </div>

        <div class="form-footer">
            Pas encore de compte ? <a href="inscription.php">S'inscrire</a>
        </div>
        <div class="form-back">
            <a href="index.php"><i class="fas fa-arrow-left"></i> Retour à l'accueil</a>
        </div>
    </div>

    <!-- fichier de message -->
    <?php if (file_exists("public/js/message.php"))
        include("public/js/message.php"); ?>

</body>

</html>
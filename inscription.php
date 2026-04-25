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
    <title>Inscription - DakarStay</title>
    <meta name="description"
        content="Créez votre compte DakarStay pour réserver votre logement et découvrir le Sénégal.">

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

    <div class="form-container animate-scale-in">
        <div class="form-icon">
            <i class="fas fa-map-marker-alt"></i>
        </div>
        <h1 class="form-title">Créer un compte</h1>
        <p class="form-subtitle">Rejoignez DakarStay pour réserver votre logement et découvrir le Sénégal</p>

        <form method="POST" action="controller/UserController.php">
            <!-- Nom & Prénom -->
            <div class="form-row">
                <div class="form-group">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" name="prenom" class="form-input" id="prenom" placeholder="Votre prénom" required>
                </div>
                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-input" id="nom" placeholder="Votre nom" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-input" id="email" placeholder="exemple@email.com" required>
            </div>

            <!-- Téléphone -->
            <div class="form-group">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" name="telephone" class="form-input" id="telephone" placeholder="+221 77 000 00 00"
                    required>
            </div>

            <!-- Quartier de Dakar -->
            <div class="form-group">
                <label for="ville" class="form-label">Quartier / Ville</label>
                <select name="ville" class="form-select" id="ville" required>
                    <option value="">-- Sélectionnez --</option>
                    <option value="Plateau">Plateau</option>
                    <option value="Almadies">Almadies</option>
                    <option value="Ngor">Ngor</option>
                    <option value="Yoff">Yoff</option>
                    <option value="Mermoz">Mermoz</option>
                    <option value="Ouakam">Ouakam</option>
                    <option value="Medina">Médina</option>
                    <option value="Parcelles">Parcelles Assainies</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <!-- Mot de passe -->
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-input" id="password"
                    placeholder="Au moins 6 caractères" minlength="6" required>
            </div>

            <!-- Confirmation mot de passe -->
            <div class="form-group">
                <label for="confirm_password" class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" class="form-input" id="confirm_password"
                    placeholder="Retapez votre mot de passe" minlength="6" required>
            </div>

            <!-- Conditions -->
            <div class="form-checkbox">
                <input type="checkbox" id="conditions" name="conditions" required>
                <label for="conditions">
                    J'accepte les <a href="#">conditions d'utilisation</a>
                </label>
            </div>

            <button type="submit" name="btnRegister" class="form-submit">
                <i class="fas fa-user-plus"></i> S'inscrire
            </button>
        </form>

        <div class="form-footer">
            Déjà un compte ? <a href="login.php">Se connecter</a>
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
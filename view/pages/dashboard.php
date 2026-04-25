<?php
session_start();

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../login.php');
    exit;
}

$nom  = $_SESSION['user_nom'];
$role = $_SESSION['user_role'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DakarStay</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <div class="form-container">
        <div class="form-icon"><i class="fas fa-home"></i></div>
        <h1 class="form-title">Bonjour, <?= htmlspecialchars($nom) ?> 👋</h1>
        <p class="form-subtitle">
            Vous êtes connecté en tant que <strong><?= htmlspecialchars($role) ?></strong>
        </p>

        <?php if ($role === 'client'): ?>
            <p>Vous pouvez explorer les logements et faire des réservations.</p>
            <a href="../../index.php" class="form-submit" style="display:block;text-align:center;text-decoration:none;margin-top:1rem;">
                <i class="fas fa-search"></i> Explorer les logements
            </a>

        <?php elseif ($role === 'proprietaire'): ?>
            <p>Gérez vos logements et consultez vos réservations.</p>
            <a href="../../index.php" class="form-submit" style="display:block;text-align:center;text-decoration:none;margin-top:1rem;">
                <i class="fas fa-building"></i> Mes logements
            </a>

        <?php elseif ($role === 'admin'): ?>
            <p>Accès administrateur — gérez toute la plateforme.</p>
            <a href="../../admin.php" class="form-submit" style="display:block;text-align:center;text-decoration:none;margin-top:1rem;">
                <i class="fas fa-cog"></i> Panneau admin
            </a>
        <?php endif; ?>

        <div class="form-footer" style="margin-top:1.5rem;">
            <a href="../../controller/UserController.php?logout=1">
                <i class="fas fa-sign-out-alt"></i> Se déconnecter
            </a>
        </div>
    </div>

    <?php if (file_exists("../../public/js/message.php"))
        include("../../public/js/message.php"); ?>
</body>
</html>

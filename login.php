<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Si déjà connecté, rediriger
if (isset($_SESSION['user_id'])) {
    header('Location: view/pages/dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Connexion - DakarStay</title>
  <meta name="description" content="Connectez-vous à votre compte DakarStay.">

  <!-- Favicons -->
  <link href="public/assets/img/favicon.png" rel="icon">
  <link href="public/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Main CSS -->
  <link href="public/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <!-- HEADER -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">DakarStay</h1>
      </a>
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="index.php#logements">Logements</a></li>
          <li><a href="index.php#excursions">Excursions</a></li>
          <li><a href="index.php#contact">Contact</a></li>
          <li><a href="login.php" class="active">Connexion</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="inscription.php">S'inscrire</a>
    </div>
  </header>

  <main class="main">

    <!-- Hero mini -->
    <section class="hero section dark-background" style="min-height: 180px;">
      <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1600&q=80" alt="" style="object-fit:cover;width:100%;height:100%;position:absolute;opacity:.4;">
      <div class="container text-center position-relative py-5" data-aos="fade-up">
        <h2 class="text-white">Connexion</h2>
        <p class="text-white-50">Accédez à votre espace personnel DakarStay</p>
      </div>
    </section>

    <!-- Formulaire de connexion -->
    <section class="contact section light-background">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8">

            <div class="card shadow-sm border-0 rounded-4 p-4 mt-4">

              <!-- Flash message -->
              <?php if (isset($_SESSION['message'])): ?>
                <div class="alert alert-<?= $_SESSION['message_type'] === 'success' ? 'success' : ($_SESSION['message_type'] === 'warning' ? 'warning' : 'danger') ?> rounded-3">
                  <?= htmlspecialchars($_SESSION['message']) ?>
                </div>
                <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
              <?php endif; ?>

              <form method="POST" action="controller/UserController.php">

                <div class="mb-3">
                  <label for="email" class="form-label fw-semibold">Email</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="exemple@email.com" required>
                  </div>
                </div>

                <div class="mb-3">
                  <label for="password" class="form-label fw-semibold">Mot de passe</label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Votre mot de passe" required>
                  </div>
                </div>

                <div class="form-check mb-3">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember">
                  <label class="form-check-label text-muted" for="remember">Se souvenir de moi</label>
                </div>

                <div class="d-grid">
                  <button type="submit" name="btnLogin" class="btn btn-primary btn-lg">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
                  </button>
                </div>

              </form>

              <hr class="my-4">

              <div class="text-center">
                <p class="mb-1 text-muted">Pas encore de compte ?</p>
                <a href="inscription.php" class="btn btn-outline-secondary w-100">
                  <i class="bi bi-person-plus me-2"></i>Créer un compte
                </a>
              </div>

              <div class="text-center mt-3">
                <a href="index.php" class="text-muted small"><i class="bi bi-arrow-left me-1"></i>Retour à l'accueil</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>

  </main>

  <!-- FOOTER simplifié -->
  <footer id="footer" class="footer dark-background py-4">
    <div class="container text-center">
      <p class="mb-0">© DakarStay — <a href="index.php" class="text-white-50">Retour à l'accueil</a></p>
    </div>
  </footer>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"><div></div><div></div><div></div><div></div></div>

  <!-- Vendor JS -->
  <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="public/assets/vendor/aos/aos.js"></script>
  <script src="public/assets/js/main.js"></script>

</body>
</html>

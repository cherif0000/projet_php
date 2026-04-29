<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">DakarStay</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Accueil</a></li>
          <li><a href="#about">À propos</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#logements">Logements</a></li>
          <li><a href="#excursions">Excursions</a></li>
          <li><a href="#avis">Avis</a></li>
          <li><a href="#faq">FAQ</a></li>
          <li><a href="#contact">Contact</a></li>

          <?php if (isset($_SESSION['user_id'])): ?>
            <li class="dropdown">
              <a href="#"><span><i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['user_nom']) ?></span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                <li><a href="view/pages/dashboard.php"><i class="bi bi-speedometer2 me-1"></i>Mon espace</a></li>
                <li><a href="controller/UserController.php?logout=1"><i class="bi bi-box-arrow-right me-1"></i>Déconnexion</a></li>
              </ul>
            </li>
          <?php else: ?>
            <li><a href="login.php">Connexion</a></li>
          <?php endif; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <?php if (!isset($_SESSION['user_id'])): ?>
        <a class="btn-getstarted" href="inscription.php">S'inscrire</a>
      <?php else: ?>
        <a class="btn-getstarted" href="view/pages/dashboard.php">Mon espace</a>
      <?php endif; ?>

    </div>
  </header>
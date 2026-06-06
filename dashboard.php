<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login");
    exit;
}
// Rafraîchir le rôle depuis la BDD à chaque chargement
require_once("model/UserDB.php");
$_refreshUser = (new UserDB())->getUserById($_SESSION['id']);
if ($_refreshUser) {
    $_SESSION['role']  = $_refreshUser['role'];
    $_SESSION['email'] = $_refreshUser['email'];
    $_SESSION['nom']   = $_refreshUser['nom'];
}
if ($_SESSION['role'] === 'proprietaire') {
    header("Location: admin");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<!-- section head -->
<?php require_once("view/sections/dashboardClient/head.php"); ?>
<body>

  <!-- HEADER -->
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" href="dashboard">Dakar<span>Stay</span></a>
      <nav class="header-nav">
        <button class="nav-btn active" onclick="showPanel('logements', this)">
          <i class="bi bi-house-door me-1"></i> Logements
        </button>
        <button class="nav-btn" onclick="showPanel('excursions', this)">
          <i class="bi bi-compass me-1"></i> Excursions
        </button>
      </nav>
      <div class="user-nav">
        <span class="user-name"><i class="bi bi-person-circle me-1"></i><?php echo htmlspecialchars($_SESSION['nom'] ?? 'Utilisateur'); ?></span>
        <a class="btn-logout" href="userController?logout=1"><i class="bi bi-box-arrow-right me-1"></i>Déconnexion</a>
      </div>
    </div>
  </header>

  <!-- section logements -->
        <?php require_once("view/sections/dashboardClient/logement.php"); ?>

  <!-- section excursions -->
        <?php require_once("view/sections/dashboardClient/excursion.php"); ?>

  <!-- section footer -->
  <footer class="site-footer">
    © 2024 <span>DakarStay</span> — Logements & Excursions au Sénégal
  </footer>
 
  <!-- section scripts -->
  <script>
    function showPanel(name, btn) {
      document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
      document.getElementById('panel-' + name).classList.add('active');
      document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
    }

    function filterLog(el, filter) {
      document.querySelectorAll('#log-filters li').forEach(li => li.classList.remove('filter-active'));
      el.classList.add('filter-active');
      document.querySelectorAll('#logements-grid .portfolio-item').forEach(item => {
        if (filter === '*') {
          item.style.display = '';
        } else {
          item.style.display = item.classList.contains(filter.replace('.','')) ? '' : 'none';
        }
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- message d'erreur -->
    <?php if (isset($_GET['error']) && $_GET['error'] == 1 && isset($_GET['message'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur de connexion',
                text: '<?php echo htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES, 'UTF-8'); ?>',
               
            });
        </script>
    <?php endif; ?>

<!-- message success -->
    <?php if (isset($_GET['Success']) && $_GET['Success'] == 1 && isset($_GET['message'])): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?php echo htmlspecialchars(urldecode($_GET['title']), ENT_QUOTES, 'UTF-8'); ?>',
                text: '<?php echo htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES, 'UTF-8'); ?>',
                timer: 1000,
                timerProgressBar: true,
                showConfirmButton: false
            });
</script>
    <?php endif; ?>


<?php if (isset($_GET['demande_ok'])): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Demande envoyée !',
  html: 'Votre demande est <strong>en cours d\'examen</strong>.<br>Notre équipe vous répondra bientôt.',
  confirmButtonColor: '#e07b39',
  confirmButtonText: 'OK'
});
</script>
<?php endif; ?>
<?php if (isset($_GET['demande_error'])): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Erreur',
  text: '<?= htmlspecialchars(urldecode($_GET["demande_msg"] ?? "Erreur inconnue"), ENT_QUOTES) ?>',
  confirmButtonColor: '#e07b39'
});
</script>
<?php endif; ?>

  <!-- Bootstrap 5 JS (requis pour les modals) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
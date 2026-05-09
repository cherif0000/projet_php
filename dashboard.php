<!DOCTYPE html>
<html lang="fr">
<!-- section head -->
<?php require_once("view/sections/dashboardClient/head.php"); ?>
<body>

  <!-- HEADER -->
  <header class="site-header">
    <div class="header-inner">
      <a class="site-logo" href="#">Dakar<span>Stay</span></a>
      <nav class="header-nav">
        <button class="nav-btn active" onclick="showPanel('logements', this)">
          <i class="bi bi-house-door me-1"></i> Logements
        </button>
        <button class="nav-btn" onclick="showPanel('excursions', this)">
          <i class="bi bi-compass me-1"></i> Excursions
        </button>
      </nav>
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

</body>
</html>
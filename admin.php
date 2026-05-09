<!DOCTYPE html>
<html lang="en">

<body>
    <!-- section head -->
		<?php require_once("view/sections/admin/head.php"); ?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

        <!-- section menu haut -->
		<?php require_once("view/sections/admin/menuHaut.php"); ?>
		
		<!-- section menu gauche -->
		<?php require_once("view/sections/admin/menuGauche.php"); ?>
		
		<!--  section base content -->
		<?php require_once("view/sections/admin/baseContent.php"); ?>
        		
		<!-- section configuration -->
		<?php require_once("view/sections/admin/config.php"); ?>
		
        <!-- section scroll to top btn -->
        <?php require_once("view/sections/admin/scroll.php"); ?>
	</div>
	
	<!-- ================== SCRIPT ================== -->
    <?php require_once("view/sections/admin/script.php"); ?>	
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
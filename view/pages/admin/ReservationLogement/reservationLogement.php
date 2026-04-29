<!DOCTYPE html>
<html lang="en">

<body>
    <!-- section head -->
		<?php require_once("../../../sections/admin/head.php"); ?>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

        <!-- section menu haut -->
		<?php require_once("../../../sections/admin/menuHaut.php"); ?>
		
		<!-- section menu gauche -->
		<?php require_once("../../../sections/admin/menuGauche.php"); ?>
		
		<!--  section base content -->
        		
		<!-- section configuration -->
		<?php require_once("../../../sections/admin/config.php"); ?>
		
        <!-- section scroll to top btn -->
        <?php require_once("../../../sections/admin/scroll.php"); ?>
	</div>
	
	<!-- ================== SCRIPT ================== -->
    <?php require_once("../../../sections/admin/script.php"); ?>	
</body>
</html>
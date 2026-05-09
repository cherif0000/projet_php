<!DOCTYPE html>
<html lang="fr">

  <!-- section head -->
    <head>
	<meta charset="utf-8" />
	<title>DakarStay | Inscription</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="public/templates/templateAdmin/assets/css/default/app.min.css" rel="stylesheet" />
    <link href="public/css/inscription.css" rel="stylesheet" />
    </head>
<body class="pace-top">
    
    <!-- section loader -->
    <?php require_once("view/sections/auth/loader.php"); ?>

    <!--  section login-cover -->
    <?php require_once("view/sections/auth/cover.php"); ?> 

    <div id="page-container" class="fade">
 
        <!-- section form -->
        <?php require_once("view/sections/auth/formRegister.php"); ?>
        
        <!-- section Scroll top -->
        <?php require_once("view/sections/auth/scrollTop.php"); ?>

    </div>


<!-- section script -->
    <script src="public/templates/templateAdmin/assets/js/app.min.js"></script>
    <script src="public/templates/templateAdmin/assets/js/theme/default.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="public/js/Validator.js"></script>
    <script src="public/js/inscription.js"></script>


<!-- message d'erreur -->
    <?php if (isset($_GET['error']) && $_GET['error'] == 1 && isset($_GET['message'])): ?>
        <script>
    Swal.fire({
        icon: 'error',
        title: '<?php echo htmlspecialchars(urldecode($_GET['title']), ENT_QUOTES, 'UTF-8'); ?>',
        text: '<?php echo htmlspecialchars(urldecode($_GET['message']), ENT_QUOTES, 'UTF-8'); ?>',
        timer: 1000,
        showConfirmButton: false,
        timerProgressBar: true
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
        showConfirmButton: false,
        timerProgressBar: true
    });
</script>
    <?php endif; ?>


</body>
</html>
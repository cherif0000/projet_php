<!DOCTYPE html>
<html lang="fr">

  <!-- section head -->
    <head>
	<meta charset="utf-8" />
	<title>DakarStay | Connexion</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link  rel="stylesheet" href="public/css/login.css"  />
	<link href="public/templates/templateAdmin/assets/css/default/app.min.css" rel="stylesheet" />
</head>
<body class="pace-top">
    
    <!-- section loader -->
    <?php require_once("view/sections/auth/loader.php"); ?>

    <!--  section login-cover -->
    <?php require_once("view/sections/auth/cover.php"); ?> 

    <div id="page-container" class="fade">
 
        <!-- section form -->
        <?php require_once("view/sections/auth/formLogin.php"); ?>        

        <!-- section Scroll top -->
        <?php require_once("view/sections/auth/scrollTop.php"); ?>

    </div>


<!-- section script -->
    <script src="public/templates/templateAdmin/assets/js/app.min.js"></script>
    <script src="public/templates/templateAdmin/assets/js/theme/default.min.js"></script>
    <script src="public/js/login.js"></script>
    <script src="public/js/Validator.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</body>
</html>
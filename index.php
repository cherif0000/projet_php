<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>DakarStay - Logements & Excursions au Sénégal</title>
  <meta name="description" content="Réservez votre logement ou excursion à Dakar et au Sénégal.">

  <!-- Favicons -->
  <link href="public/templates/templateVitrine/assets/img/favicon.png" rel="icon">
  <link href="public/templates/templateVitrine/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&family=Raleway:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS -->
  <link href="public/templates/templateVitrine/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="public/templates/templateVitrine/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Main CSS -->
  <link href="public/templates/templateVitrine/assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

  <!-- ======= section menu ======= -->
  <?php require_once("view/sections/vitrine/menu.php"); ?>

  <main class="main">
      
    <!-- ======= section bannière ======= -->
    <?php require_once("view/sections/vitrine/banniere.php"); ?>

    <!-- ======= section À propos ======= -->
  
    <?php require_once("view/sections/vitrine/Apropos.php"); ?>

    <!-- ======= section SERVICES ======= -->
    <?php require_once("view/sections/vitrine/service.php"); ?>

    <!-- ======= section Avis ======= -->
    <?php require_once("view/sections/vitrine/avis.php"); ?>

   <!-- ======= section FAQ ======= -->
    <?php require_once("view/sections/vitrine/faq.php"); ?>

    <!-- ======= section CONTACT ======= -->
    <?php require_once("view/sections/vitrine/contact.php"); ?>

  </main>

  <!-- ======= section FOOTER ======= -->
  <?php require_once("view/sections/vitrine/footer.php"); ?>


  <!-- ======= section configuration ======= -->
  <?php require_once("view/sections/vitrine/config.php"); ?>

</body>
  
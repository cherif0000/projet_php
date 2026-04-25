<?php
/**
 * DakarStay - Point d'entrée principal
 * 
 * Ce fichier inclut la page vitrine (homepage) avec le design Perspective
 */

// Démarrer la session si nécessaire
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Charger la page vitrine
require_once 'public/templates/templateVitrine/vitrine.php';
?>

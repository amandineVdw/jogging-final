<?php
// ============================================================
// SWITCHER DE THÈME
// Stocke le thème choisi en session et revient à la page précédente.
// POURQUOI la session : persiste entre toutes les pages sans paramètre URL.
// ============================================================

session_start();

$themes_valides = ['officiel', 'dark', 'innojp'];
$theme = $_GET['theme'] ?? 'officiel';

if (in_array($theme, $themes_valides)) {
    $_SESSION['theme'] = $theme;
}

// Retour à la page d'où on vient (ou accueil si pas de référent)
$retour = $_SERVER['HTTP_REFERER'] ?? '../index.php';
header('Location: ' . $retour);
exit();

<?php
// ============================================================
// ROUTEUR CENTRAL — index.php
// C'est la porte d'entrée unique du site.
// Toutes les URLs passent par ici : index.php?page=news, etc.
// ============================================================

// POURQUOI session_start() en tout premier :
// Doit être avant tout output HTML et avant tout header().
// Sans ça, les variables de session ($_SESSION) ne sont pas accessibles.
session_start();

// Affichage des erreurs (à retirer avant mise en prod)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// --- Routeur : quelle page afficher ? ---
$page = $_GET['page'] ?? 'accueil';

// SÉCURITÉ — liste blanche des pages autorisées.
// Sans ça, un visiteur pourrait injecter n'importe quel chemin de fichier.
$pages_autorisees = ['accueil', 'news', 'resultats', 'contact', 'admin-news', 'admin-resultats'];

if (!in_array($page, $pages_autorisees)) {
    $page = 'accueil';
}

// --- PROTECTION ADMIN ---
// POURQUOI ici (dans le routeur) et pas dans chaque page admin :
// On centralise la sécurité en un seul endroit.
// Si on oublie de vérifier dans une page admin, cette garde couvre quand même.
$pages_admin = ['admin-news', 'admin-resultats'];

if (in_array($page, $pages_admin)) {
    if (empty($_SESSION['connecte'])) {
        // Pas connecté → page login
        header('Location: login.php');
        exit();
    }
    if ($_SESSION['role'] !== 'admin') {
        // Connecté mais pas admin → retour accueil
        $page = 'accueil';
    }
}

// --- Initiale pour l'avatar nav ---
$initiale = '';
if (!empty($_SESSION['nom'])) {
    $initiale = strtoupper(mb_substr($_SESSION['nom'], 0, 1));
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogging de l'IFOSUP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== NAVIGATION ===== -->
<nav>

    <!-- Liens publics -->
    <a href="index.php?page=accueil"   <?= $page === 'accueil'   ? 'class="actif"' : '' ?>>Accueil</a>
    <a href="index.php?page=news"      <?= $page === 'news'      ? 'class="actif"' : '' ?>>News</a>
    <a href="index.php?page=resultats" <?= $page === 'resultats' ? 'class="actif"' : '' ?>>Résultats</a>
    <a href="index.php?page=contact"   <?= $page === 'contact'   ? 'class="actif"' : '' ?>>Contact</a>

    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <!-- Liens admin — visibles uniquement pour le rôle admin -->
        <div class="nav-sep"></div>
        <a href="index.php?page=admin-news"      <?= $page === 'admin-news'      ? 'class="actif"' : '' ?>>Admin News</a>
        <a href="index.php?page=admin-resultats" <?= $page === 'admin-resultats' ? 'class="actif"' : '' ?>>Admin Résultats</a>
    <?php endif; ?>

    <!-- Zone utilisateur — poussée à droite par margin-left: auto dans le CSS -->
    <div class="nav-user">
        <?php if (!empty($_SESSION['connecte'])): ?>
            <div class="nav-avatar"><?= htmlspecialchars($initiale) ?></div>
            <span class="nav-nom"><?= htmlspecialchars($_SESSION['nom']) ?></span>
            <a href="actions/action-logout.php" class="btn-logout">Déconnexion</a>
        <?php else: ?>
            <a href="login.php" class="btn-connexion">Connexion</a>
        <?php endif; ?>
    </div>

</nav>

<!-- ===== CONTENU ===== -->
<div class="container">
    <?php include("pages/{$page}.php"); ?>
</div>

</body>
</html>

<?php
// ============================================================
// ROUTEUR CENTRAL — index.php
// ============================================================

session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// --- Thème actif (stocké en session, défaut : officiel) ---
$theme = $_SESSION['theme'] ?? 'officiel';

// --- Routeur ---
$page = $_GET['page'] ?? 'accueil';

$pages_autorisees = ['accueil', 'news', 'resultats', 'contact', 'admin-news', 'admin-resultats'];
if (!in_array($page, $pages_autorisees)) {
    $page = 'accueil';
}

// --- Protection admin ---
$pages_admin = ['admin-news', 'admin-resultats'];
if (in_array($page, $pages_admin)) {
    if (empty($_SESSION['connecte'])) {
        header('Location: login.php');
        exit();
    }
    if ($_SESSION['role'] !== 'admin') {
        $page = 'accueil';
    }
}

// --- Titres dynamiques par page ---
$titres = [
    'accueil'          => 'Accueil',
    'news'             => 'News',
    'resultats'        => 'Résultats',
    'contact'          => 'Contact',
    'admin-news'       => 'Admin — News',
    'admin-resultats'  => 'Admin — Résultats',
];
$titre_page = ($titres[$page] ?? 'Page') . ' — Jogging de l\'IFOSUP';

// --- Initiale avatar ---
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
    <title><?= htmlspecialchars($titre_page) ?></title>
    <!-- Favicon emoji 🏃 -->
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🏃</text></svg>">
    <link rel="stylesheet" href="css/style.css">
</head>
<!-- POURQUOI body class : le CSS utilise body.theme-dark pour surcharger
     les variables CSS sans toucher au HTML. Un seul attribut change tout. -->
<body class="theme-<?= htmlspecialchars($theme) ?>">

<!-- ===== NAVIGATION ===== -->
<nav>
    <a href="index.php?page=accueil"   <?= $page === 'accueil'   ? 'class="actif"' : '' ?>>Accueil</a>
    <a href="index.php?page=news"      <?= $page === 'news'      ? 'class="actif"' : '' ?>>News</a>
    <a href="index.php?page=resultats" <?= $page === 'resultats' ? 'class="actif"' : '' ?>>Résultats</a>
    <a href="index.php?page=contact"   <?= $page === 'contact'   ? 'class="actif"' : '' ?>>Contact</a>

    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <div class="nav-sep"></div>
        <a href="index.php?page=admin-news"      <?= $page === 'admin-news'      ? 'class="actif"' : '' ?>>Admin News</a>
        <a href="index.php?page=admin-resultats" <?= $page === 'admin-resultats' ? 'class="actif"' : '' ?>>Admin Résultats</a>
    <?php endif; ?>

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

<!-- ===== FOOTER — switcher de thème discret ===== -->
<!-- 3 petits cercles. Faut savoir qu'ils sont là. -->
<footer>
    <div class="theme-switcher">
        <a href="actions/action-theme.php?theme=officiel"
           class="theme-dot dot-officiel <?= $theme === 'officiel' ? 'actif' : '' ?>"
           title="Officiel"></a>
        <a href="actions/action-theme.php?theme=dark"
           class="theme-dot dot-dark <?= $theme === 'dark' ? 'actif' : '' ?>"
           title="Dark"></a>
        <a href="actions/action-theme.php?theme=innojp"
           class="theme-dot dot-innojp <?= $theme === 'innojp' ? 'actif' : '' ?>"
           title="Innojp"></a>
    </div>
</footer>

</body>
</html>

<?php
// Page accueil — stats dynamiques depuis la DB + ton selon le thème
include('config/connexion.php');

$nb_total  = $pdo->query('SELECT COUNT(*) FROM resultats')->fetchColumn();
$meilleur  = $pdo->query('SELECT MIN(ResTps) FROM resultats')->fetchColumn();
$nb_femmes = $pdo->query("SELECT COUNT(*) FROM resultats WHERE ResSexe='F'")->fetchColumn();
$nb_hommes = $pdo->query("SELECT COUNT(*) FROM resultats WHERE ResSexe='M'")->fetchColumn();

// $theme est disponible car défini dans index.php avant l'include
$theme = $_SESSION['theme'] ?? 'officiel';
?>

<?php if (!empty($_SESSION['connecte'])): ?>
    <div class="bienvenue-badge">
        👋 <?= htmlspecialchars($_SESSION['nom']) ?>
        <?= $_SESSION['role'] === 'admin' ? ' — Admin' : '' ?>
    </div>
<?php endif; ?>

<?php if ($theme === 'dark'): ?>

    <h1>Jogging de l'IFOSUP.</h1>
    <p>Des gens ont couru. Voici les résultats. C'est un site PHP. Il tourne.</p>

    <div class="stats-bloc">
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_total ?></span>
            <span class="stat-label">ont couru</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $meilleur ?></span>
            <span class="stat-label">meilleur temps</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_femmes ?></span>
            <span class="stat-label">femmes</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_hommes ?></span>
            <span class="stat-label">hommes</span>
        </div>
    </div>

<?php elseif ($theme === 'innojp'): ?>

    <h1>Jogging de l'IFOSUP. Dans la vie, quoi.</h1>
    <p><?= $nb_total ?> bougres ont couru. <?= $nb_femmes ?> meufs. <?= $nb_hommes ?> gars.
    Le meilleur a mis <?= $meilleur ?>. C'est Bruno. C'est toujours Bruno. Dans la vie, quoi.</p>

    <div class="stats-bloc">
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_total ?></span>
            <span class="stat-label">participants</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $meilleur ?></span>
            <span class="stat-label">record (Bruno, évidemment)</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_femmes ?> / <?= $nb_hommes ?></span>
            <span class="stat-label">F / M</span>
        </div>
    </div>

<?php else: ?>

    <h1>Jogging de l'IFOSUP</h1>
    <p>Bienvenue sur le site officiel du jogging scolaire de l'IFOSUP.
    Retrouvez le classement complet des participants et les dernières actualités.</p>

    <div class="stats-bloc">
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_total ?></span>
            <span class="stat-label">participants</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $meilleur ?></span>
            <span class="stat-label">meilleur temps</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_femmes ?></span>
            <span class="stat-label">femmes</span>
        </div>
        <div class="stat-item">
            <span class="stat-chiffre"><?= $nb_hommes ?></span>
            <span class="stat-label">hommes</span>
        </div>
    </div>

<?php endif; ?>

<?php
// Page statique — pas de connexion DB nécessaire.
// $_SESSION est accessible car session_start() est dans index.php.
?>

<?php if (!empty($_SESSION['connecte'])): ?>
    <div class="bienvenue-badge">
        👋 Bonjour, <?= htmlspecialchars($_SESSION['nom']) ?> !
        <?= $_SESSION['role'] === 'admin' ? ' — Connecté en tant qu\'admin' : '' ?>
    </div>
<?php endif; ?>

<h1>Jogging de l'IFOSUP</h1>

<p>
    Bienvenue sur le site officiel du jogging scolaire de l'IFOSUP.
    Retrouvez ici les news, les résultats de la course et toutes les informations
    pratiques pour les participants.
</p>

<br>

<p>
    Que vous soyez coureur, accompagnateur ou simple curieux, vous trouverez
    le classement complet et les dernières actualités de l'événement.
</p>

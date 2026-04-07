<?php
// ============================================================
// PAGE DE CONNEXION
// Fichier séparé (pas dans pages/) car il ne partage pas
// le layout de index.php — il a son propre design centré.
// ============================================================

session_start();

// Déjà connecté → retour à l'accueil directement
if (!empty($_SESSION['connecte'])) {
    header('Location: index.php');
    exit();
}

$erreur = isset($_GET['erreur']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Jogging de l'IFOSUP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="page-login">

<div class="login-wrapper">

    <div class="login-box">

        <div class="login-logo">
            <span class="login-icon">🏃</span>
        </div>

        <h1 class="login-titre">Jogging de l'IFOSUP</h1>
        <p class="login-sous-titre">Espace administration</p>

        <?php if ($erreur): ?>
            <div class="msg-err">Identifiants incorrects. Réessaie.</div>
        <?php endif; ?>

        <form action="actions/action-login.php" method="post" class="login-form">

            <div class="champ">
                <label for="username">Identifiant</label>
                <input type="text" name="username" id="username"
                       placeholder="admin ou visiteur" required autofocus>
            </div>

            <div class="champ">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password"
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>

        </form>

        <a href="index.php" class="login-retour">← Retour au site sans connexion</a>

    </div>

</div>

</body>
</html>

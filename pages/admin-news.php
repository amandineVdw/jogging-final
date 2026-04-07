<?php
// ============================================================
// ADMIN NEWS — CRUD complet
// Double sécurité : index.php vérifie déjà le rôle,
// mais on re-vérifie ici au cas où la page serait incluse autrement.
// ============================================================

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<p class='msg-err'>Accès refusé.</p>";
    return;
}

include('config/connexion.php');

// Message de confirmation après une action
if (isset($_GET['msg'])) {
    $messages = [
        'ajoute'   => 'News ajoutée avec succès !',
        'modifie'  => 'News modifiée avec succès !',
        'supprime' => 'News supprimée avec succès !',
    ];
    if (isset($messages[$_GET['msg']])) {
        echo "<p class='msg-ok'>" . $messages[$_GET['msg']] . "</p>";
    }
}

// ID de la news à modifier (null = aucune modification en cours)
$id_modifier = null;
if (isset($_POST['montrer_modifier'])) {
    $id_modifier = $_POST['montrer_modifier'];
}
?>

<h1>Administration — News</h1>

<!-- ===== FORMULAIRE AJOUT ===== -->
<h2>Ajouter une news</h2>

<form action="actions/action-news.php" method="post">
    <input type="hidden" name="action" value="ajouter">
    <div class="champ">
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre" required>
    </div>
    <div class="champ">
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu" required></textarea>
    </div>
    <input type="submit" value="Ajouter la news">
</form>

<!-- ===== LISTE DES NEWS ===== -->
<h2>Liste des news</h2>

<?php
$requete = $pdo->query('SELECT * FROM news ORDER BY NewID DESC');

if ($requete->rowCount() === 0) {
    echo "<p>Aucune news pour le moment.</p>";
} else {
    while ($ligne = $requete->fetch()) {

        if ($id_modifier == $ligne['NewID']) {
            // Formulaire de modification inline
            ?>
            <div class="form-modifier">
                <form action="actions/action-news.php" method="post">
                    <input type="hidden" name="action" value="modifier">
                    <input type="hidden" name="id" value="<?= $ligne['NewID'] ?>">
                    <div class="champ">
                        <label>Titre</label>
                        <input type="text" name="titre" value="<?= htmlspecialchars($ligne['NewTitre']) ?>" required>
                    </div>
                    <div class="champ">
                        <label>Contenu</label>
                        <textarea name="contenu" required><?= htmlspecialchars($ligne['NewContenu']) ?></textarea>
                    </div>
                    <input type="submit" value="Enregistrer">
                    <a href="index.php?page=admin-news" class="btn-annuler">Annuler</a>
                </form>
            </div>
            <?php
        } else {
            // Affichage normal avec boutons
            ?>
            <div class="admin-ligne">
                <span class="nom"><?= htmlspecialchars($ligne['NewTitre']) ?></span>
                <form action="actions/action-news.php" method="post">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="id" value="<?= $ligne['NewID'] ?>">
                    <input type="submit" value="Supprimer" class="btn-sup">
                </form>
                <form action="index.php?page=admin-news" method="post">
                    <input type="hidden" name="montrer_modifier" value="<?= $ligne['NewID'] ?>">
                    <input type="submit" value="Modifier" class="btn-mod">
                </form>
            </div>
            <?php
        }
    }
}
?>

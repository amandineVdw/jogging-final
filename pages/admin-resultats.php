<?php
// ============================================================
// ADMIN RÉSULTATS — CRUD complet
// ============================================================

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<p class='msg-err'>Accès refusé.</p>";
    return;
}

include('config/connexion.php');

if (isset($_GET['msg'])) {
    $messages = [
        'ajoute'   => 'Résultat ajouté avec succès !',
        'modifie'  => 'Résultat modifié avec succès !',
        'supprime' => 'Résultat supprimé avec succès !',
    ];
    if (isset($messages[$_GET['msg']])) {
        echo "<p class='msg-ok'>" . $messages[$_GET['msg']] . "</p>";
    }
}

$id_modifier = null;
if (isset($_POST['montrer_modifier'])) {
    $id_modifier = $_POST['montrer_modifier'];
}
?>

<h1>Administration — Résultats</h1>

<!-- ===== FORMULAIRE AJOUT ===== -->
<h2>Ajouter un résultat</h2>

<form action="actions/action-resultats.php" method="post">
    <input type="hidden" name="action" value="ajouter">
    <div class="champ">
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" required>
    </div>
    <div class="champ">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" required>
    </div>
    <div class="champ">
        <label for="temps">Temps (hh:mm:ss)</label>
        <input type="time" name="temps" id="temps" step="1" required>
    </div>
    <div class="champ">
        <label>Sexe</label>
        <div class="radio-group">
            <label><input type="radio" name="sexe" value="M" checked> M</label>
            <label><input type="radio" name="sexe" value="F"> F</label>
        </div>
    </div>
    <input type="submit" value="Ajouter le résultat">
</form>

<!-- ===== LISTE DES RÉSULTATS ===== -->
<h2>Liste des résultats</h2>

<?php
$requete = $pdo->query('SELECT * FROM resultats ORDER BY ResTps ASC');

if ($requete->rowCount() === 0) {
    echo "<p>Aucun résultat pour le moment.</p>";
} else {
    while ($ligne = $requete->fetch()) {

        if ($id_modifier == $ligne['ResID']) {
            ?>
            <div class="form-modifier">
                <form action="actions/action-resultats.php" method="post">
                    <input type="hidden" name="action" value="modifier">
                    <input type="hidden" name="id" value="<?= $ligne['ResID'] ?>">
                    <div class="champ">
                        <label>Nom</label>
                        <input type="text" name="nom" value="<?= htmlspecialchars($ligne['ResNom']) ?>" required>
                    </div>
                    <div class="champ">
                        <label>Prénom</label>
                        <input type="text" name="prenom" value="<?= htmlspecialchars($ligne['ResPrenom']) ?>" required>
                    </div>
                    <div class="champ">
                        <label>Temps (hh:mm:ss)</label>
                        <input type="time" name="temps" step="1" value="<?= htmlspecialchars($ligne['ResTps']) ?>" required>
                    </div>
                    <div class="champ">
                        <label>Sexe</label>
                        <div class="radio-group">
                            <label><input type="radio" name="sexe" value="M" <?= $ligne['ResSexe'] === 'M' ? 'checked' : '' ?>> M</label>
                            <label><input type="radio" name="sexe" value="F" <?= $ligne['ResSexe'] === 'F' ? 'checked' : '' ?>> F</label>
                        </div>
                    </div>
                    <input type="submit" value="Enregistrer">
                    <a href="index.php?page=admin-resultats" class="btn-annuler">Annuler</a>
                </form>
            </div>
            <?php
        } else {
            ?>
            <div class="admin-ligne">
                <span class="nom"><?= htmlspecialchars($ligne['ResNom']) . ' ' . htmlspecialchars($ligne['ResPrenom']) ?></span>
                <form action="actions/action-resultats.php" method="post">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="id" value="<?= $ligne['ResID'] ?>">
                    <input type="submit" value="Supprimer" class="btn-sup">
                </form>
                <form action="index.php?page=admin-resultats" method="post">
                    <input type="hidden" name="montrer_modifier" value="<?= $ligne['ResID'] ?>">
                    <input type="submit" value="Modifier" class="btn-mod">
                </form>
            </div>
            <?php
        }
    }
}
?>

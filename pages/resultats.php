<?php
// Page résultats — filtre M/F + podium + flavor text par thème
include('config/connexion.php');

$theme  = $_SESSION['theme'] ?? 'officiel';
$filtre = $_GET['filtre'] ?? 'tous';
if (!in_array($filtre, ['tous', 'M', 'F'])) $filtre = 'tous';

// Requête avec filtre optionnel sur le sexe
if ($filtre === 'tous') {
    $req = $pdo->query('SELECT * FROM resultats ORDER BY ResTps ASC');
} else {
    $req = $pdo->prepare('SELECT * FROM resultats WHERE ResSexe = ? ORDER BY ResTps ASC');
    $req->execute([$filtre]);
}

// Titres et notes selon le thème
if ($theme === 'dark') {
    $titre = 'Résultats.';
    $intro = 'Classement par ordre de souffrance décroissante.';
    $note  = 'HERME Olaf. Dernier. Il était là quand même.';
} elseif ($theme === 'innojp') {
    $titre = 'Les chiffres ne mentent pas. Dans la vie, quoi.';
    $intro = 'Tout le monde est dans ce tableau. Même ceux qui auraient préféré ne pas l\'être.';
    $note  = 'HERME Olaf — 00:17:06. Dernier. Ce site lui doit autant qu\'au premier. Dans la vie, quoi.';
} else {
    $titre = 'Résultats de la course';
    $intro = 'Classement complet des participants, triés par temps.';
    $note  = '';
}
?>

<h1><?= $titre ?></h1>
<?php if ($intro): ?>
    <p style="color:var(--texte-doux); margin-bottom:16px;"><?= $intro ?></p>
<?php endif; ?>

<!-- Filtre M / F / Tous -->
<div class="filtre-bloc">
    <a href="index.php?page=resultats&filtre=tous" class="btn-filtre <?= $filtre === 'tous' ? 'actif' : '' ?>">Tous</a>
    <a href="index.php?page=resultats&filtre=M"    class="btn-filtre <?= $filtre === 'M'    ? 'actif' : '' ?>">Hommes</a>
    <a href="index.php?page=resultats&filtre=F"    class="btn-filtre <?= $filtre === 'F'    ? 'actif' : '' ?>">Femmes</a>
</div>

<table>
    <thead>
        <tr>
            <th>Position</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Temps</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $position = 1;
    while ($ligne = $req->fetch()):
        if     ($position === 1) { $classe = 'pos-1'; $medaille = '🥇 '; }
        elseif ($position === 2) { $classe = 'pos-2'; $medaille = '🥈 '; }
        elseif ($position === 3) { $classe = 'pos-3'; $medaille = '🥉 '; }
        else                     { $classe = '';       $medaille = ''; }
    ?>
        <tr <?= $classe ? "class=\"$classe\"" : '' ?>>
            <td><span class="badge-pos"><?= $medaille . $position ?></span></td>
            <td><?= htmlspecialchars($ligne['ResNom']) ?></td>
            <td><?= htmlspecialchars($ligne['ResPrenom']) ?></td>
            <td><?= htmlspecialchars($ligne['ResSexe']) ?></td>
            <td><?= htmlspecialchars($ligne['ResTps']) ?></td>
        </tr>
    <?php
        $position++;
    endwhile;
    ?>
    </tbody>
</table>

<?php if ($note && $filtre === 'tous'): ?>
    <p class="note-dernier"><?= $note ?></p>
<?php endif; ?>

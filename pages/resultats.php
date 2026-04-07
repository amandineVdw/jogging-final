<?php
// Page dynamique — affiche le classement trié par temps croissant.
include('config/connexion.php');

$requete = $pdo->query('SELECT * FROM resultats ORDER BY ResTps ASC');
?>

<h1>Résultats de la course</h1>

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
    // POURQUOI un compteur PHP et non une colonne "position" en DB :
    // La position change à chaque ajout/suppression. On la calcule ici,
    // une seule fois, dans l'ordre du SELECT (déjà trié par temps).
    $position = 1;

    while ($ligne = $requete->fetch()):

        // Classe CSS selon le rang pour le podium or/argent/bronze
        if     ($position === 1) $classe = 'pos-1';
        elseif ($position === 2) $classe = 'pos-2';
        elseif ($position === 3) $classe = 'pos-3';
        else                     $classe = '';

        // Médaille pour les 3 premiers
        if     ($position === 1) $medaille = '🥇 ';
        elseif ($position === 2) $medaille = '🥈 ';
        elseif ($position === 3) $medaille = '🥉 ';
        else                     $medaille = '';
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

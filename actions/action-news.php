<?php
// ============================================================
// TRAITEMENT CRUD — NEWS
// Reçoit les données POST et redirige après chaque action.
// POURQUOI prepare/execute et non query() :
//   Les données viennent de l'utilisateur ($_POST).
//   Les ? sont des paramètres que PDO nettoie automatiquement
//   → protection contre les injections SQL.
// ============================================================

include('../config/connexion.php');

if (isset($_POST['action'])) {

    if ($_POST['action'] === 'ajouter') {
        $req = $pdo->prepare('INSERT INTO news (NewTitre, NewContenu) VALUES (?, ?)');
        $req->execute([$_POST['titre'], $_POST['contenu']]);
        header('Location: ../index.php?page=admin-news&msg=ajoute');
        exit();
    }

    if ($_POST['action'] === 'modifier') {
        $req = $pdo->prepare('UPDATE news SET NewTitre=?, NewContenu=? WHERE NewID=?');
        $req->execute([$_POST['titre'], $_POST['contenu'], $_POST['id']]);
        header('Location: ../index.php?page=admin-news&msg=modifie');
        exit();
    }

    if ($_POST['action'] === 'supprimer') {
        $req = $pdo->prepare('DELETE FROM news WHERE NewID=?');
        $req->execute([$_POST['id']]);
        header('Location: ../index.php?page=admin-news&msg=supprime');
        exit();
    }
}

// Accès direct sans action → retour à l'admin
header('Location: ../index.php?page=admin-news');
exit();

<?php
// ============================================================
// TRAITEMENT CRUD — RÉSULTATS
// ============================================================

include('../config/connexion.php');

if (isset($_POST['action'])) {

    if ($_POST['action'] === 'ajouter') {
        $req = $pdo->prepare('INSERT INTO resultats (ResNom, ResPrenom, ResTps, ResSexe) VALUES (?, ?, ?, ?)');
        $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['temps'], $_POST['sexe']]);
        header('Location: ../index.php?page=admin-resultats&msg=ajoute');
        exit();
    }

    if ($_POST['action'] === 'modifier') {
        $req = $pdo->prepare('UPDATE resultats SET ResNom=?, ResPrenom=?, ResTps=?, ResSexe=? WHERE ResID=?');
        $req->execute([$_POST['nom'], $_POST['prenom'], $_POST['temps'], $_POST['sexe'], $_POST['id']]);
        header('Location: ../index.php?page=admin-resultats&msg=modifie');
        exit();
    }

    if ($_POST['action'] === 'supprimer') {
        $req = $pdo->prepare('DELETE FROM resultats WHERE ResID=?');
        $req->execute([$_POST['id']]);
        header('Location: ../index.php?page=admin-resultats&msg=supprime');
        exit();
    }
}

header('Location: ../index.php?page=admin-resultats');
exit();

<?php
// ============================================================
// TRAITEMENT DU FORMULAIRE DE CONNEXION
// Reçoit username + password depuis login.php (méthode POST)
// ============================================================

// POURQUOI session_start() en premier :
// doit être appelé avant tout output HTML et avant tout header().
session_start();

include('../config/utilisateurs.php');

if (isset($_POST['username'], $_POST['password'])) {

    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    // Vérifie que le nom d'utilisateur existe dans notre tableau
    if (isset($utilisateurs[$user]) && $utilisateurs[$user]['motdepasse'] === $pass) {

        // POURQUOI session_regenerate_id :
        // Génère un nouvel ID de session après le login pour empêcher
        // la "fixation de session" — une attaque où quelqu'un vole l'ID
        // d'une session non authentifiée et l'utilise après connexion.
        session_regenerate_id(true);

        // On stocke les infos utiles en session
        $_SESSION['connecte']    = true;
        $_SESSION['utilisateur'] = $user;
        $_SESSION['role']        = $utilisateurs[$user]['role'];
        $_SESSION['nom']         = $utilisateurs[$user]['nom'];

        header('Location: ../index.php');
        exit();

    } else {
        // Mauvais identifiants → on repasse sur le login avec un message d'erreur
        header('Location: ../login.php?erreur=1');
        exit();
    }
}

// Accès direct sans POST → retour à l'accueil
header('Location: ../index.php');
exit();

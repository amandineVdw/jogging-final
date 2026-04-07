<?php
// ============================================================
// CONNEXION À LA BASE DE DONNÉES
// Utilise les variables d'environnement Railway si disponibles,
// sinon bascule sur les valeurs locales Laragon.
// => permet de déployer sans changer ce fichier.
// ============================================================

$host   = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'jogging';
$user   = getenv('DB_USER') ?: 'root';
$pass   = getenv('DB_PASS') ?: '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // POURQUOI ERRMODE_EXCEPTION : si une requête SQL plante,
    // PHP génère une vraie erreur visible au lieu de passer en silence.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

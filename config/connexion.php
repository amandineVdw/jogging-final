<?php
// ============================================================
// CONNEXION À LA BASE DE DONNÉES
// Utilise les variables d'environnement Railway si disponibles,
// sinon bascule sur les valeurs locales Laragon.
// => permet de déployer sans changer ce fichier.
// ============================================================

// Railway injecte MYSQLHOST, MYSQLUSER, etc. automatiquement.
// En local (Laragon), ces variables n'existent pas → fallback sur localhost.
$host   = getenv('MYSQLHOST')     ?: 'localhost';
$dbname = getenv('MYSQLDATABASE') ?: 'jogging';
$user   = getenv('MYSQLUSER')     ?: 'root';
$pass   = getenv('MYSQLPASSWORD') ?: '';
$port   = getenv('MYSQLPORT')     ?: '3306';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    // POURQUOI ERRMODE_EXCEPTION : si une requête SQL plante,
    // PHP génère une vraie erreur visible au lieu de passer en silence.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

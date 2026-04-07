<?php
// ============================================================
// CONNEXION À LA BASE DE DONNÉES
// Utilise les variables d'environnement Railway si disponibles,
// sinon bascule sur les valeurs locales Laragon.
// => permet de déployer sans changer ce fichier.
// ============================================================

// Détection automatique de l'environnement :
// - Sur InfinityFree (domaine .free.nf) → credentials production
// - En local (Laragon) → localhost/root
$host_actuel = $_SERVER['HTTP_HOST'] ?? 'localhost';

if (str_contains($host_actuel, 'free.nf') || str_contains($host_actuel, 'infinityfree')) {
    // === PRODUCTION (InfinityFree) ===
    $host   = 'sql103.infinityfree.com';
    $dbname = 'if0_41605255_jogging';
    $user   = 'if0_41605255';
    $pass   = 'bkjnmgCtRbv';
} else {
    // === LOCAL (Laragon) ===
    $host   = getenv('MYSQLHOST')     ?: 'localhost';
    $dbname = getenv('MYSQLDATABASE') ?: 'jogging';
    $user   = getenv('MYSQLUSER')     ?: 'root';
    $pass   = getenv('MYSQLPASSWORD') ?: '';
}
$port = getenv('MYSQLPORT') ?: '3306';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    // POURQUOI ERRMODE_EXCEPTION : si une requête SQL plante,
    // PHP génère une vraie erreur visible au lieu de passer en silence.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

<?php
// ============================================================
// UTILISATEURS AUTORISÉS
// Codés en dur — pas de table DB nécessaire pour l'auth.
// Même principe que copains : simple, direct, maîtrisé.
//
// En production réelle : on utiliserait password_hash() pour
// stocker des mots de passe chiffrés. Ici c'est simplifié
// volontairement pour que la logique reste lisible.
// ============================================================

$utilisateurs = [
    'admin'    => ['motdepasse' => 'admin123', 'role' => 'admin',    'nom' => 'Administrateur'],
    'visiteur' => ['motdepasse' => 'visit123', 'role' => 'visiteur', 'nom' => 'Visiteur'],
];

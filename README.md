# Jogging de l'IFOSUP

Site de gestion d'un jogging scolaire — résultats, news, administration.

## Stack

- PHP 8+ / PDO
- MySQL
- CSS pur (variables, responsive)
- Session PHP (authentification)

## Installation locale (Laragon)

1. Cloner le repo dans `C:/laragon/www/jogging-final/`
2. Importer `jogging.sql` dans phpMyAdmin (base `jogging`)
3. Ouvrir `http://localhost/jogging-final/`

## Comptes de démonstration

| Utilisateur | Mot de passe | Rôle      |
|-------------|-------------|-----------|
| `admin`     | `admin123`  | Admin     |
| `visiteur`  | `visit123`  | Visiteur  |

> L'admin peut ajouter, modifier et supprimer les news et résultats.
> Le visiteur consulte uniquement.

## Structure

```
jogging-final/
├── index.php          # Routeur central + nav
├── login.php          # Page de connexion
├── config/
│   ├── connexion.php  # Connexion PDO (env vars Railway ou localhost)
│   └── utilisateurs.php # Utilisateurs codés en dur
├── pages/             # Vues incluses par index.php
├── actions/           # Traitements POST (CRUD + login/logout)
└── css/
    └── style.css      # Tout le style, variables CSS
```

## Déploiement Railway

Variables d'environnement à configurer :
- `DB_HOST`
- `DB_NAME`
- `DB_USER`
- `DB_PASS`

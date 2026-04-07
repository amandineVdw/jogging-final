# CLAUDE.md — Jogging de l'IFOSUP

## État du projet (arrêt : 08/04/2026)

### Ce qui est en place et fonctionnel
- Site PHP complet : routeur, CRUD news + résultats, login/session/rôles
- 3 thèmes CSS (officiel/dark/innojp) via variables CSS + body class
- Switcher 3 dots en footer
- Stats dynamiques sur l'accueil (COUNT/MIN SQL)
- Filtre M/F sur les résultats
- News filtrées par `NewTone` en DB
- Titres dynamiques + favicon 🏃
- Déployé sur InfinityFree (HTTP) : joggingifosup.free.nf
- GitHub : github.com/amandineVdw/jogging-final

### DB InfinityFree
- Host : sql103.infinityfree.com
- User : if0_41605255
- DB : if0_41605255_jogging
- News : 3 officiel + 4 dark + 5 innojp (colonnes NewTone + NewDate)

### Comptes de démo
| User | Password | Rôle |
|---|---|---|
| admin | admin123 | Admin |
| visiteur | visit123 | Visiteur |

---

## Ce qui ne va pas — à retravailler

### 1. Humour trop tiède
Le ton dark et innojp actuel est moins piquant/caustique que les versions
précédentes (`jogging-dark/jogging_dark.sql` et `jogging-innojp/jogging_innojp.sql`).
Aller relire ces fichiers pour retrouver l'ADN. En particulier :
- Les genoux optionnels → bien mais peut aller plus loin
- HERME Olaf note → bien mais trop court
- Innojp : les 5 news existantes sont bonnes, sharpener les punchlines

### 2. Switcher 3 dots — trop accessible, pas exclusif
**Problème :** n'importe qui peut switcher de thème. Ça tue le côté "private joke".
**Direction :** supprimer les dots. À la place, lier le thème au compte utilisateur.
- Quand tu te connectes avec un compte, ton thème est automatiquement activé
- dark et innojp sont des thèmes "VIP" — faut le pass (le bon login)
- C'est le modèle jogging-hybrid mais plus assumé

### 3. Ajouter des users thématiques
```php
$utilisateurs = [
    'admin'    => ['motdepasse' => 'admin123',    'role' => 'admin',    'theme' => 'officiel', 'nom' => 'Administrateur'],
    'visiteur' => ['motdepasse' => 'visit123',    'role' => 'visiteur', 'theme' => 'officiel', 'nom' => 'Visiteur'],
    'dark'     => ['motdepasse' => '???',         'role' => 'visiteur', 'theme' => 'dark',     'nom' => 'L\'Ombre'],
    'gilles'   => ['motdepasse' => 'letparballes','role' => 'visiteur', 'theme' => 'innojp',   'nom' => 'Gilles'],
];
```
- Connexion avec 'dark' → thème dark auto, contenu dark
- Connexion avec 'gilles' → thème innojp auto, humour belge
- Le thème est stocké dans `$_SESSION['theme']` à la connexion
- Retirer les 3 dots du footer (ou les laisser visibles uniquement pour admin)

### 4. Supprimer les dots publics
Dans `index.php`, supprimer ou conditionner le footer switcher :
```php
// Option : visible uniquement si admin
<?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <footer>...</footer>
<?php endif; ?>
```

---

## Fichiers clés
- `config/utilisateurs.php` → ajouter les users thématiques + champ 'theme'
- `actions/action-login.php` → stocker `$_SESSION['theme']` depuis le user
- `index.php` → retirer/conditionner le footer dots
- `pages/news.php` → déjà filtre par NewTone, rien à changer
- `pages/accueil.php` → déjà ton par thème, affiner les textes

## References humour à relire
- `C:/laragon/www/EXAM - XBACK/jogging-dark/jogging_dark.sql`
- `C:/laragon/www/EXAM - XBACK/jogging-innojp/jogging_innojp.sql`
- `C:/laragon/www/EXAM - XBACK/jogging-hybrid/pages/admin-news.php` (messages CRUD par thème)

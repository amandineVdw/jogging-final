<?php
// Page news — filtrée par le thème actif (NewTone)
// POURQUOI filtrer : chaque thème a son propre contenu éditorial.
// L'admin ne gère que les news 'officiel' — les autres sont des easter eggs.
include('config/connexion.php');

$theme = $_SESSION['theme'] ?? 'officiel';

$req = $pdo->prepare('SELECT * FROM news WHERE NewTone = ? ORDER BY NewDate DESC');
$req->execute([$theme]);
?>

<h1><?= $theme === 'dark' ? 'News.' : ($theme === 'innojp' ? 'Ce qui se passe. Dans la vie, quoi.' : 'News') ?></h1>

<?php if ($req->rowCount() === 0): ?>
    <p><?= $theme === 'dark' ? 'Rien à signaler. C\'est peut-être mieux ainsi.' : 'Aucune news pour le moment.' ?></p>
<?php else: ?>
    <?php while ($ligne = $req->fetch()): ?>
        <div class="news-item">
            <h3><?= htmlspecialchars($ligne['NewTitre']) ?></h3>
            <p><?= nl2br(htmlspecialchars($ligne['NewContenu'])) ?></p>
            <?php if (!empty($ligne['NewDate'])): ?>
                <small style="color:var(--texte-doux); font-size:11px; margin-top:8px; display:block;">
                    <?= date('d/m/Y', strtotime($ligne['NewDate'])) ?>
                </small>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

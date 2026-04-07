<?php
// Page dynamique — affiche toutes les news depuis la DB.
include('config/connexion.php');

$requete = $pdo->query('SELECT * FROM news ORDER BY NewID DESC');
?>

<h1>News</h1>

<?php if ($requete->rowCount() === 0): ?>
    <p>Aucune news pour le moment.</p>
<?php else: ?>
    <?php while ($ligne = $requete->fetch()): ?>
        <div class="news-item">
            <h3><?= htmlspecialchars($ligne['NewTitre']) ?></h3>
            <p><?= nl2br(htmlspecialchars($ligne['NewContenu'])) ?></p>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

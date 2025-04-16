<?php
require_once(__DIR__ . '/../partials/head.php');
?>
<main class="licenceCss">
    <h1 class="tittleAnnouncement">Annonces Licences</h1>
    <div class="buttonLicence1">
    <?php if (!empty($_SESSION['user'])) { ?>
        <?php if ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2) { ?>
            <button type="submit"><a href="/addLicence"  class="aLicence"> Ajouter une licence</a></button>
        <?php } ?>
    <?php } else { ?>
        <p class="LicenceAnnonce">Vous devez être connecté pour ajouter une licence.</p>
    <?php } ?>
</div>
    <!-- Affichage des cartes -->
    <?php if (!empty($licences)): ?>
        <div class="licence-cards">
            <?php foreach ($licences as $licence): ?>
                <?php if ($licence->getAvailability()): // Vérifie si la licence est disponible 
                ?>
                    <a href="/licenceDetail?id=<?= $licence->getId(); ?>" class="card">
                        <img src="<?= htmlspecialchars($licence->getPicturePath()) ?>" alt="<?= htmlspecialchars($licence->getTitle()) ?>">
                        <h2><?= htmlspecialchars($licence->getTitle()) ?></h2>
                        <p><?= htmlspecialchars($licence->getDescription()) ?></p>
                        <p class="price">Prix: <?= htmlspecialchars($licence->getPrice()) ?> €</p>

                        <!-- Bouton Acheter -->
                        <!-- Bouton Acheter -->
                        <form class="formLicence" action="/licenceDetail" method="get">
                            <input type="hidden" name="id" value="<?= $licence->getId(); ?>">
                            <button type="submit" class="buy-button">Réservé</button>
                        </form>

                    </a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune licence disponible.</p>
    <?php endif; ?>
</main>

<?php require_once(__DIR__ . '/../partials/footer.php'); 
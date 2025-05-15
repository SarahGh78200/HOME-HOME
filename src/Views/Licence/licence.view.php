<?php
require_once(__DIR__ . '/../partials/head.php');
?>
<main class="licenceCss">
    <h1 class="tittleAnnouncement">Annonces Licences</h1>
    <div class="buttonLicence1">
    <?php if (!empty($_SESSION['user'])) { ?>
        <?php if ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2) { ?>
            <button type="submit" class="submit11"><a href="/addLicence"  class="aLicence"> Ajouter une licence</a></button>
        <?php } ?>
    <?php } else { ?>
        <p class="LicenceAnnonce">Vous devez être connecté pour ajouter une licence.</p>
    <?php } ?>
</div>
    <!-- Affichage des cartes -->
    <?php if (!empty($myLicences)): ?>
        <div class="licence-cards">
            <?php foreach ($myLicences as $licence): ?>
                <?php if ($licence->getAvailability()): // Vérifie si la licence est disponible 
                ?>
                    <a href="/licenceDetail=<?= $licence->getId(); ?>" class="card">
    
                        <p>Description:<?= $licence->getDescription() ?></p>
                        <p>Disponibilité:<?= $licence->getAvailability() ?></p>
                        <p>Prix: <?= $licence->getPrice() ?> </p>
                        <p>Type:<?= $licence->getType() ?></p>
                        <p>Date de mises en service:<?= $licence->getCommissioning_date() ?></p>
                        <p>Ville:<?= $licence->getCity() ?></p>
                        
                    <a href=""></a>
                        <!-- Bouton Acheter -->
                        <!-- Bouton Acheter -->
                        <form class="formLicence" action="/licenceDetail" method="get">
                            <input type="hidden" name="id" value="<?= $licence->getLicenceById(); ?>">
                            <button type="submit" class="buy-button">Voir plus</button>
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
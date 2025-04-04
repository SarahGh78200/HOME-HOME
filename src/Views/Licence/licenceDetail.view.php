<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>
<main class="detailLicence.css">

    <h1>Détails de la Licence</h1>

    <div class="licence-detail">
        <img src="<?= htmlspecialchars($myLicence->getPicturePath() ?? '') ?>"
            alt="<?= htmlspecialchars($myLicence->getTitle() ?? '') ?>"
            class="licence-detail-img">

        <h2><?= htmlspecialchars($myLicence->getTitle() ?? '') ?></h2>

        <p><strong>Description :</strong> <?= htmlspecialchars($myLicence->getDescription() ?? '') ?></p>
        <p class="price"><strong>Prix :</strong> <?= htmlspecialchars($myLicence->getPrice() ?? '') ?> €</p>
        <p><strong>Vendeur :</strong> <?= htmlspecialchars($userInfo['name'] ?? ''); ?> (<?= htmlspecialchars($userInfo['email'] ?? ''); ?>)</p>

        <!-- Bouton Réserver -->
        <a href="/contact-vendeur/:id<?= $myLicence->getId() ?>" class="buy-button">Contacter le vendeur</a>


    </div>
    </div>
</main>


<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
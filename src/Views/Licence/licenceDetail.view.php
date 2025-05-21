<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<main class="detailLicence.css">

    <h1>Détails de la Licence</h1>

    <div class="licence-detail">

        <p class="pDetail"><strong>Description :</strong> <?= ($myLicence->getDescription() ?? '') ?></p>
        <p class="pDetail"><strong>Type :</strong> <?= ($myLicence->getType() ?? '') ?></p>
        <p class="pDetail"><strong>Date de mise en service :</strong> <?= ($myLicence->getCommissioning_date() ?? '') ?></p>
        <p class="pDetail"><strong>Ville :</strong> <?= ($myLicence->getCity() ?? '') ?></p>

        <p class="price"><strong>Prix :</strong> <?= ($myLicence->getPrice() ?? '') ?> €</p>

        <p class="pDetail">
            <strong>Contacter le vendeur par mail :</strong>
            <?php if ($myLicence->getEmail()): ?>
                <a href="mailto:<?= htmlspecialchars($myLicence->getEmail()) ?>">
                    <?= htmlspecialchars($myLicence->getEmail()) ?>
                </a>
            <?php else: ?>
                <span>Email non disponible</span>
            <?php endif; ?>
        </p>

    </div>
</main>


<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
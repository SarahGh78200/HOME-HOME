<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails de la Licence</title>
    <link rel="stylesheet" href="/public/css/licenceDetail.css">
</head>
<body>

    <h1>Détails de la Licence</h1>

    <div class="licence-detail">
        <img src="<?= htmlspecialchars($myLicence->getPicturePath()) ?>" 
             alt="<?= htmlspecialchars($myLicence->getTitle()) ?>" 
             class="licence-detail-img">
        
        <h2><?= htmlspecialchars($myLicence->getTitle()) ?></h2>
        
        <p><strong>Description :</strong> <?= htmlspecialchars($myLicence->getDescription()) ?></p>
        <p class="price"><strong>Prix :</strong> <?= htmlspecialchars($myLicence->getPrice()) ?> €</p> 
        <p><strong>Status :</strong> <?= $myLicence->getAvailability() ? 'Disponible' : 'Indisponible' ?></p>
        
        <p><strong>Vendeur :</strong> <?= htmlspecialchars($userInfo['name']); ?> (<?= htmlspecialchars($userInfo['email']); ?>)</p>

        <div class="actions">
            <!-- Bouton Réserver -->
            <form action="/contactVendeur" method="GET">
                <input type="hidden" name="licenceId" value="<?= $licence->getId(); ?>">
                <button type="submit" class="buy-button">Réserver</button>
            </form>

            <form action="/contactVendeur?licenceId=<?= $licence->getId(); ?>" method="GET">
    <input type="hidden" name="licence_id" value="<?= $licence->getId(); ?>">
    <button type="submit" class="buy-button">Réserver la Licence</button>
</form>

        </div>
    </div>

</body>
</html>

<?php require_once(__DIR__ . '/../partials/footer.php'); ?>

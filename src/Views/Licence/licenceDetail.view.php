
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
        <img src="<?= htmlspecialchars($myLicence->getPicturePath()) ?>" alt="<?= htmlspecialchars($myLicence->getTitle()) ?>" class="licence-detail-img">
        <h2><strong></strong><?= htmlspecialchars($myLicence->getTitle()) ?></h2>
        <p><strong>Description:</strong><?= htmlspecialchars($myLicence->getDescription()) ?></p>
        <p class="price"><strong> Prix:<?= htmlspecialchars($myLicence->getPrice()) ?> €</p></strong> 
        <p>Status: <?= $myLicence->getAvailability() ? 'Disponible' : 'Indisponible' ?></p>
        <p><strong>Utilisateur :</strong> <?= htmlspecialchars($userInfo['name']); ?><?= htmlspecialchars($userInfo['name']); ?> (<?= htmlspecialchars($userInfo['email']); ?>)</p>
          <!-- Bouton Acheter -->
          <form action="/acheterLicence" method="post">
                            <input type="hidden" name="licence_id" value="<?= $licence->getId(); ?>">
                            <button type="submit" class="buy-button">Réservé</button>
                        </form>
    </div>
</body>
</html>
<?php require_once(__DIR__ . '/../partials/footer.php'); ?>

<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contacter le Vendeur</title>
    <link rel="stylesheet" href="/public/css/licenceDetail.css">
</head>
<body>

    <h1>Comment Acheter la Licence</h1>

    <div class="licence-detail">
        <h2><strong><?= htmlspecialchars($licence->getTitle()) ?></strong></h2>
        <p><strong>Description:</strong> <?= htmlspecialchars($licence->getDescription()) ?></p>
        <p><strong>Prix:</strong> <?= htmlspecialchars($licence->getPrice()) ?> €</p>
        <p><strong>Disponibilité:</strong> <?= $licence->getAvailability() ? 'Disponible' : 'Indisponible' ?></p>

        <h3>Contactez le Vendeur</h3>
        <p><strong>Nom:</strong> <?= htmlspecialchars($userInfo['name']); ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($userInfo['email']); ?></p>

        <h4>Pour réserver cette licence :</h4>
        <ul>
            <li>1. Contactez le vendeur par email ou téléphone.</li>
            <li>2. Discutez des conditions d'achat.</li>
            <li>3. Finalisez la transaction après avoir convenu des modalités.</li>
        </ul>
        <p>Si vous êtes prêt à réserver, envoyez un email à <?= htmlspecialchars($userInfo['email']); ?> en indiquant votre intérêt pour cette licence.</p>

        <!-- Bouton de contact par email -->
        <a href="mailto:<?= htmlspecialchars($userInfo['email']); ?>" class="btn">Contacter le Vendeur par Email</a>
    </div>

</body>
</html>

<?php
// Inclusion du pied de page
require_once(__DIR__ . '/../partials/footer.php');
?>

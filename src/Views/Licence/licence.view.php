<!-- :Inclusion du fichier head (contient les balises <head>, les liens CSS, etc.) -->
<?php
require_once(__DIR__ . '/../partials/head.php'); ?>

<main class="licenceCss">
    <!-- Titre principal de la page -->
    <h1 class="tittleAnnouncemenpeut tu me commentezr le codet">Annonces Licences</h1>

    <div class="buttonLicence1">
        <?php
        // Vérifie si l'utilisateur est connecté
        if (!empty($_SESSION['user'])) {
            // Vérifie si l'utilisateur a un rôle autorisé à ajouter une licence (1 ou 2)
            if ($_SESSION['user']['idRole'] == 1 || $_SESSION['user']['idRole'] == 2) { ?>
                <!-- Bouton pour accéder à la page d'ajout de licence -->
               
                    <a href="/addLicence" class="aLicence">Ajouter une licence</a>
            
            <?php
            }
        } else { ?>
            <!-- Message si l'utilisateur n'est pas connecté -->
            <p class="LicenceAnnonce">Vous devez être connecté pour ajouter une licence.</p>
        <?php } ?>
    </div>

    <!-- Affichage des cartes de licences si la variable $myLicences n’est pas vide -->
    <?php if (!empty($myLicences)): ?>
        <div class="licence-cards">
<?php foreach ($myLicences as $licence): ?>
    <?php if ($licence->getAvailability()): ?>
        <div class="card">
            <p><strong>Description :</strong> <?= htmlspecialchars($licence->getDescription()) ?></p>
            <p><strong>Prix :</strong> <?= htmlspecialchars($licence->getPrice()) ?> €</p>
            <p><strong>Type :</strong> <?= htmlspecialchars($licence->getType()) ?></p>
            <p><strong>Date de mise en service :</strong> <?= htmlspecialchars($licence->getCommissioning_date()) ?></p>
            <p><strong>Ville :</strong> <?= strtoupper(htmlspecialchars($licence->getCity())) ?></p>
            
            
            <a href="/licenceDetailById?id=<?= $licence->getId(); ?>" class="voir-plus">Voir plus</a>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

        </div>
    <?php else: ?>
        <!-- Message si aucune licence n’est disponible -->
        <p>Aucune licence disponible.</p>
    <?php endif; ?>
</main>

<?php
// Inclusion du footer
require_once(__DIR__ . '/../partials/footer.php');
?>
<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<main class="profilCss">
    <h1 class="tittleProfil">Profil de <?= htmlspecialchars($user->getName()) ?></h1>
    <div class="profil">
        <p><strong>Nom :</strong> <?= htmlspecialchars($user->getSurname()) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($user->getName()) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($user->getEmail()) ?></p>
        <p><strong>Date de naissance :</strong> <?= htmlspecialchars($user->getBirthDate()) ?></p>
        <div class="buttonEditProfile">
            <button onclick="window.location.href='/editProfilUser'">Modifier mon profil</button>
        </div>
    </div>

    <div class="buttonMyLicence">
        <button onclick="window.location.href='/licenceUser'">Mes Licences</button>
    </div>
</main>

<?php require_once(__DIR__ . '/../partials/footer.php'); ?>

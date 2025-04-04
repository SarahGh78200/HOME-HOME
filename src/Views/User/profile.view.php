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
            <a href="/editProfilUser">Modifier mon profil</a>
        </div>

    </div>

    <div class="buttonMyLicence">
        <a href="/licenceUser"> Mes Licences</a>
    </div>
</main>


<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
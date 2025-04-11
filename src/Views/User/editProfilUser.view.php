<?php require_once(__DIR__ . '/../partials/head.php'); ?>

<main class="editProfilCss">
<h2 class="title2profil">Modifier mon profil</h2>

<?php if (isset($errorMessage)): ?>
    <p style="color: red;"><?= htmlspecialchars($errorMessage) ?></p>
<?php endif; ?>

<form class="licenceform"  action="/editProfilUser" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($user->getId()) ?>">

    <label for="surname">Nom :</label>
    <input type="text" id="surname" name="surname" value="<?= htmlspecialchars($user->getSurname()) ?>" required>

    <label for="name">Prénom :</label>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->getName()) ?>" required>


    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" required>


    <button  type="submit">Enregistrer</button>
</form>
</main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>

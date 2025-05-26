<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/partials/head.php');
?>

<main class="bodycontactCss">
    <div class="contact-container">
        <h1>Nous Contacter</h1>

        <!-- Test session -->
        <?php if (!empty($_SESSION['user'])): ?>
            <p style="color:green;">Connecté en tant que : <?= htmlspecialchars($_SESSION['user']['surname'] ?? '') ?></p>
        <?php else: ?>
            <p style="color:red;">Non connecté</p>
        <?php endif; ?>

        <p><strong>Vous avez une question ou une demande ? Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</strong></p>

        <?php if (!empty($name)) echo "<p style='color:green;'>$name</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form action="/contact" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="objet">Objet :</label>
                <input type="text" id="objet" name="objet" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button class="buttonContact" type="submit">Envoyer</button>
        </form>
    </div>
</main>

<?php require_once(__DIR__ . '/partials/footer.php'); ?>

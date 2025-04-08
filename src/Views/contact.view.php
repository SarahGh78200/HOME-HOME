<?php
require_once(__DIR__ . '/partials/head.php');
?>

<main class="bodycontactCss">
    <div class="contact-container">
        <h2>Nous Contacter</h2>
        <p>Vous avez une question ou une demande ? Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</p>

        <?php if (!empty($name)) echo "<p style='color:green;'>$name</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>


        <form action="/contact" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
        <div class="form-group">
            <label for="oject">objet</label>
<input type="text" id="object" objet>
        </div>

            <div class="form-group">
                <label for="email">E-mail :</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>

            <button type="submit">Envoyer</button>
        </form>
    </div>
</main>

<?php require_once(__DIR__ . '/partials/footer.php'); ?>

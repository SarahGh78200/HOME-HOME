<?php
// Inclusion du fichier head
require_once(__DIR__ . '/partials/head.php');
?>
<style>
    .bodycontactCss {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f5f5f5;
}

.contact-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 400px;
    text-align: center;
}

.contact-container h2 {
    margin-bottom: 10px;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

label {
    display: block;
    font-weight: bold;
}

input, textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background: #0056b3;
}

</style>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    if (!empty($nom) && !empty($email) && !empty($message)) {
        // Envoi du mail (remplace l'email ci-dessous par celui du support)
        $to = "support@exemple.com";
        $subject = "Nouveau message de contact";
        $headers = "From: " . $email . "\r\n" . "Reply-To: " . $email;

        $mailBody = "Nom: $nom\n";
        $mailBody .= "E-mail: $email\n";
        $mailBody .= "Message:\n$message\n";

        if (mail($to, $subject, $mailBody, $headers)) {
            echo "Votre message a bien été envoyé. Nous vous répondrons rapidement.";
        } else {
            echo "Erreur lors de l'envoi du message. Veuillez réessayer plus tard.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} else {
    echo "Méthode non autorisée.";
}
?>

<main class="bodycontactCss">

    <div class="contact-container">
        <h2>Nous Contacter</h2>
        <p>Vous avez une question ou une demande ? Remplissez le formulaire ci-dessous, nous vous répondrons rapidement.</p>

        <form action="traitement_contact.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
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

<?php
// Inclusion du fichier footer
require_once(__DIR__ . '/partials/footer.php');
?>

<?php

namespace App\Controllers;

use App\mailer\contactMailer;


class ContactController
{
    public function index()
    {
        $successMessage = '';
        $errorMessage = '';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nom= htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            if (!empty($nom) && !empty($email) && !empty($message)) {
                $mailer = new contactMailer();

                if ($mailer->send($nom, $email, $message)) {
                    $successMessage = "Votre message a bien été envoyé. Nous vous répondrons rapidement.";
                } else {
                    $errorMessage = "Erreur lors de l'envoi du message. Veuillez réessayer plus tard.";
                }
            } else {
                $errorMessage = "Veuillez remplir tous les champs.";
            }
        }

        // On passe les messages à la vue
        require_once(__DIR__ . '/../Views/contact.view.php');

    }
}

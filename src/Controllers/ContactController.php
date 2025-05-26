<?php

namespace App\Controllers;

use App\mailer\contactMailer;

class ContactController
{
    public function index()
    {
        // Variables pour afficher un message à l'utilisateur dans la vue
        $successMessage = '';
        $errorMessage = '';

        // Vérifie si le formulaire a été soumis en POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Récupère et sécurise les données envoyées depuis le formulaire
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            // Vérifie que tous les champs ont été remplis
            if (!empty($nom) && !empty($email) && !empty($message)) {

                // Instancie le service d'envoi d'email
                $mailer = new contactMailer();

                // Appelle la méthode send() pour envoyer l'e-mail
                if ($mailer->send($nom, $email, $message)) {
                    $successMessage = "Votre message a bien été envoyé. Nous vous répondrons rapidement.";
                } else {
                    $errorMessage = "Erreur lors de l'envoi du message. Veuillez réessayer plus tard.";
                }

            } else {
                // Un ou plusieurs champs sont vides
                $errorMessage = "Veuillez remplir tous les champs.";
            }
        }

        // Charge la vue du formulaire de contact avec les messages
        require_once(__DIR__ . '/../Views/contact.view.php');
    }
}

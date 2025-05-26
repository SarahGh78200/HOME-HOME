<?php

// Déclaration du namespace pour organiser le code dans App\Mailer
namespace App\Mailer;

// Importation des classes nécessaires de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Déclaration de la classe contactMailer
class contactMailer
{
    // Fonction publique pour envoyer un email avec les paramètres : nom, email, message
    public function send($nom, $email, $message)
    {
        // Création d'une nouvelle instance de PHPMailer avec les exceptions activées
        $mail = new PHPMailer(true);

        try {
            // Configuration pour utiliser SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP de Gmail
            $mail->SMTPAuth = true;         // Activation de l’authentification SMTP
            $mail->Username = 'freemoovedriver1@gmail.com'; // Adresse email utilisée pour envoyer
            $mail->Password = 'hkuy ifmc cofr rlpd';         // Mot de passe d’application Gmail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Chiffrement sécurisé (SSL)
            $mail->Port = 465;                              // Port SMTP pour SSL

            // Définition de l’expéditeur (nom et email saisis par l’utilisateur)
            $mail->setFrom($email, $nom);

            // Destinataire du message (adresse fixe du site)
            $mail->addAddress('freemoovedriver1@gmail.com');

            // Format HTML activé
            $mail->isHTML(true);
            $mail->Subject = "Message de contact"; // Sujet de l'email

            // Corps du message en HTML
            $mail->Body = "<strong>Nom :</strong> $nom<br><strong>Email :</strong> $email<br><strong>Message :</strong><br>" . nl2br($message);

            // Version texte brut de l’email (fallback)
            $mail->AltBody = "Name : $nom\nEmail : $email\nMessage :\n$message";

            // Envoi de l’email
            $mail->send();

            // Retourne vrai si l'envoi a réussi
            return true;
        } catch (Exception $e) {
            // En cas d’erreur, on enregistre le message d’erreur dans les logs
            error_log("Erreur d'envoi : " . $mail->ErrorInfo);

            // Retourne faux si l’envoi a échoué
            return false;
        }
    }
}

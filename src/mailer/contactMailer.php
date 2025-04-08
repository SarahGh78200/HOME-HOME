<?php

namespace App\Mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class contactMailer
{

    public function send($nom, $email, $message)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'freemoovedriver1@gmail.com'; // Email
            $mail->Password = 'ybyc jexf ijiw tzzy'; // MDP DE L'APPLICATION
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom($email, $nom);
            $mail->addAddress('freemoovedriver1@gmail.com'); // Ton destinataire

            $mail->isHTML(true);
            $mail->Subject = "Message de contact";
            $mail->Body = "<strong>Nom :</strong> $nom<br><strong>Email :</strong> $email<br><strong>Message :</strong><br>" . nl2br($message);
            $mail->AltBody = "Name : $nom\nEmail : $email\nMessage :\n$message";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur d'envoi : " . $mail->ErrorInfo);
            return false;
        }
    }


}

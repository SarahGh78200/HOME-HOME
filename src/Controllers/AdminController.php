<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class AdminController extends AbstractController
{
    /**
     * Supprime une licence depuis le tableau de bord admin.
     * 
     * Cette méthode est appelée lorsqu’un formulaire envoie un champ `id`
     * (identifiant de la licence à supprimer).
     * 
     * Elle :
     *  - récupère l'ID envoyé en POST
     *  - instancie un objet Licence en lui passant l'ID (les autres paramètres à null)
     *  - appelle la méthode `deleteLicence()` du modèle Licence
     *  - redirige vers le tableau de bord
     */
    public function deleteLicence()
    {
        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);

            // Création d’un objet Licence uniquement avec l’ID
            $licence = new Licence(
                $idLicence,  // ID à supprimer
                null, null, null, null, null, null, null, null
            );

            // Appel de la méthode deleteLicence() du modèle Licence
            $licence->deleteLicence();

            // Redirection après suppression
            $this->redirectToRoute('/dashboard');
        }
    }

    /**
     * Supprime un utilisateur depuis le tableau de bord admin.
     * 
    
     *  - récupère l'ID de l'utilisateur
     *  - instancie un objet User avec uniquement l’ID
     *  - appelle la méthode `deleteUser()` du modèle User
     *  - redirige ensuite vers le tableau de bord
     */
    public function deleteUser()
    {
        if (isset($_POST['id'])) {
            $idUser = htmlspecialchars($_POST['id']);

            // Création d’un objet User avec l’ID
            $user = new User(
                $idUser,
                null, null, null, null, null, null, null, null
            );

            // Appel de la méthode deleteUser() du modèle User
            $user->deleteUser();

            // Redirection après suppression
            $this->redirectToRoute('/dashboard');
        }
    }
}

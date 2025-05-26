<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class LicenceController extends AbstractController
{
    /**
     * Ajouter une licence (utilisateur connecté)
     */
    public function addLicence()
    {
        // Vérifie que l'utilisateur est connecté avec un rôle
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['idRole'])) {
            $this->redirectToRoute('/');
        }

        // Vérifie que le formulaire a été soumis
        if (isset($_POST['type'])) {
            // Valide les champs requis
            $this->check('description', $_POST['description']);
            $this->check('price', $_POST['price']);
            $this->check('type', $_POST['type']);
            $this->check('commissioning_date', $_POST['commissioning_date']);
            $this->check('city', $_POST['city']);

            // Si aucune erreur
            if (empty($this->arrayError)) {
                // Récupère les données du formulaire
                $description = htmlspecialchars($_POST['description']);
                $price = htmlspecialchars($_POST['price']);
                $type = htmlspecialchars($_POST['type']);
                $commissioning_date = htmlspecialchars($_POST['commissioning_date']);
                $city = htmlspecialchars($_POST['city']);
                $id_user = $_SESSION['user']['idUser'];

                $availability = 1; // Disponible par défaut

                // Instancie une licence
                $licence = new Licence(
                    null, $description, $availability, $price,
                    $type, $commissioning_date, $city, $id_user, null
                );

                // Enregistre la licence
                $licence->addLicence();

                // Redirige vers la liste des licences
                $this->redirectToRoute('getAllLicence');
            }
        }

        // Affiche la vue du formulaire d’ajout
        require_once(__DIR__ . "/../Views/Licence/addLicence.view.php");
    }

    /**
     * Affiche toutes les licences (public ou utilisateur)
     */
    public function getAllLicence()
    {
        $licence = new Licence(null, null, null, null, null, null, null, null, null);
        $myLicences = $licence->getAllLicence(); // Récupère toutes les licences via le modèle

        require_once(__DIR__ . "/../Views/Licence/licence.view.php");
    }

    /**
     * Affiche les détails d’une licence par son ID
     */
    public function getLicenceById()
    {
        if (isset($_GET['id'])) {
            $idLicence = $_GET['id'];

            // Instancie et récupère la licence
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            // Si un POST est envoyé depuis le détail (commentaire ? réservation ?)
            if (isset($_POST['user'])) {
                $user = htmlspecialchars($_POST['user']);
                $this->checkFormat('user', $user);

                if (empty($this->arrayError)) {
                    $description = htmlspecialchars($_POST['description']);
                    $availability = htmlspecialchars($_POST['availability']);
                    $price = htmlspecialchars($_POST['price']);
                    $type = htmlspecialchars($_POST['type']);
                    $commissioning_date = htmlspecialchars($_POST['commissioning_date']);
                    $city = htmlspecialchars($_POST['city']);
                    // Traitement additionnel ici si besoin
                }
            }

            require_once(__DIR__ . "/../Views/Licence/licenceDetail.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    /**
     * Affiche le formulaire d’édition d’une licence existante
     */
    public function editLicence()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirectToRoute('/login');
        }

        $id = (int) ($_GET['id'] ?? 0);
        $licenceEdit = new Licence($id, null, null, null, null, null, null, null, null);
        $licence = $licenceEdit->getLicenceById();

        if (!$licence) {
            $this->redirectToRoute('/licenceUser');
        }

        require_once __DIR__ . '/../Views/Licence/editLicence.view.php';
    }

    /**
     * Met à jour une licence (utilisateur)
     */
    public function updateLicenceUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) $_POST['id'];
            $description = htmlspecialchars($_POST['description']);
            $price = (float) $_POST['price'];
            $availability = isset($_POST['availability']) ? 1 : 0;
            $type = htmlspecialchars($_POST['type']);
            $commissioning_date = htmlspecialchars($_POST['commissioning_date']);
            $city = htmlspecialchars($_POST['city']);

            // Création d’un objet Licence mis à jour
            $licence = new Licence(
                $id, $description, $availability, $price,
                $type, $commissioning_date, $city, null, null
            );

            // Appelle le modèle pour enregistrer la mise à jour
            $licence->updateLicenceUser();

            $this->redirectToRoute('/licenceUser');
        } else {
            $this->redirectToRoute('/');
        }
    }

    /**
     * Supprime une licence (utilisateur)
     */
    public function deleteLicence()
    {
        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);

            // Instancie l'objet avec l’ID
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null);

            // Supprime depuis le modèle
            $licence->deleteLicence();

            $this->redirectToRoute('/licenceUser');
        }
    }
}
 
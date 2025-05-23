<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class LicenceController extends AbstractController
{
    public function index()
    {
        if (isset($_GET['id'])) {
            $idLicence = htmlspecialchars($_GET['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null);
            // $myLicence = $licence->getLicenceById();

            // if (!$myLicence) {
            //     $this->redirectToRoute('/');
            // }

            // $idUser = $myLicence->getIdUser();
            // $user = new User($idUser, null, null, null, null, null, null);

            // require_once(__DIR__ . "/../Views/licence/licence.view.php");
        } else {
        }
    }

    //USER
public function addLicence()
{
    // Vérifie si l'utilisateur est connecté et a un rôle
    if (!isset($_SESSION['user']) || empty($_SESSION['user']['idRole'])) {
        $this->redirectToRoute('/');
    }

    // Vérifie si le formulaire est soumis
    if (isset($_POST['type'])) {
        $this->check('description', $_POST['description']);
        $this->check('price', $_POST['price']);
        $this->check('type', $_POST['type']);
        $this->check('commissioning_date', $_POST['commissioning_date']);
        $this->check('city', $_POST['city']);

        // Si aucun message d'erreur
        if (empty($this->arrayError)) {
            // htmlspecialchars empêche l'exécution de script malveillant
            $description = htmlspecialchars($_POST['description']);
            $price = htmlspecialchars($_POST['price']);
            $type = htmlspecialchars($_POST['type']);
           $commissioning_date = htmlspecialchars($_POST['commissioning_date']);
            $city = htmlspecialchars($_POST['city']);
            $id_user = $_SESSION['user']['idUser'];

            // je definie la  disponibilité automatiquement à 1 
            $availability = 1;

            // J'instancie la classe Licence
            $licence = new Licence(
                null,               
                $description,
                $availability,      
                $price,
                $type,
                $commissioning_date,
                $city,
                $id_user,
                null                
            );

            // J'ajoute la licence à la base de données
            $licence->addLicence();

            // Je redirige vers la page d'accueil
            $this->redirectToRoute('getAllLicence');
        }
    }

    // J'affiche la vue du formulaire
    require_once(__DIR__ . "/../Views/Licence/addLicence.view.php");
}//NEW





    public function getAllLicence()
    {
        $licence = new Licence(null, null, null, null, null, null, null, null, null);
        $myLicences = $licence->getAllLicence();

        require_once(__DIR__ . "/../Views/Licence/licence.view.php");
    }

    public function getLicenceById()
    {

        if (isset($_GET['id'])) {

            $idLicence = $_GET['id'];

            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            if (isset($_POST['user'])) {
                $user = htmlspecialchars($_POST['user']);


                $this->checkFormat('user', $user);

                if (empty($this->arrayError)) {

                    $description = htmlspecialchars($_POST['description']);
                    $availability = htmlspecialchars($_POST['availability']);
                    $price = htmlspecialchars($_POST['price']);
                    $type = htmlspecialchars($_POST['type']);
                    $commissioning_date = htmlspecialchars($_POST['commissioning_date']); // <— corrigé
                    $city = htmlspecialchars($_POST['city']);
                }
            }

            require_once(__DIR__ . "/../Views/Licence/licenceDetail.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }//NEW


public function editLicence()
{
    // 1. Protection : utilisateur loggué
    if (!isset($_SESSION['user'])) {
        $this->redirectToRoute('/login');
    }

    // 2. Récupère l’ID et la licence
    $id = (int) ($_GET['id'] ?? 0);
  // Bon : on instancie d’abord un objet avec l’ID, puis on appelle la méthode
$licenceEdit = new Licence($id, null, null, null, null, null, null, null,null);
$licence      = $licenceEdit->getLicenceById();

    if (!$licence) {
        $this->redirectToRoute('/licenceUser');
    }

    // 3. Envoie à la vue
    require_once __DIR__ . '/../Views/Licence/editLicence.view.php';
}
//function pour modifier la licence de l'utilisateur
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
        
       

        // Instancie l'objet Licence avec les données mises à jour
        $licence = new Licence($id, $description, $availability, $price, $type, $commissioning_date, $city, null,null);

        // Appelle la méthode du modèle pour mettre à jour la licence
        $licence->updateLicenceUser();

        // Redirection vers la liste
        $this->redirectToRoute('/licenceUser');
    } else {
        $this->redirectToRoute('/');
    }
}//NEW



    public function deleteLicence()
    {

        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null);
            $licence->deleteLicence();
            $this->redirectToRoute('/licenceUser');
        }
    }//NEW









}
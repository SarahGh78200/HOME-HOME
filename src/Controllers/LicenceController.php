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

    // public function addLicence()
    // {
    //     //AJOUTE LES COMMENTAIRE
    //     if (!isset($_SESSION['user']) || empty($_SESSION['user']['idRole'])) {
    //         $this->redirectToRoute('/');
    //     }
    //     if (isset($_POST['type'])) {
    //         $this->check('description', $_POST['description']);
    //         $this->check('availability', $_POST['availability']);
    //         $this->check('price', $_POST['price']);
    //         $this->check('type', $_POST['type']);
    //         $this->check('commisionning_date', $_POST['commisionning_date']);
    //         $this->check('city', $_POST['city']);
    //         $this->check('id_user', $_POST['id_user']);

    //         if (empty($this->arrayError)) {

    //             $description = htmlspecialchars($_POST['description']);
    //             $availability = htmlspecialchars($_POST['availability']);
    //             $price = htmlspecialchars($_POST['price']);
    //             $type = htmlspecialchars($_POST['type']);
    //             $commisionning_date = htmlspecialchars($_POST['commisionning_date']);
    //             $city = htmlspecialchars($_POST['city']);
    //             $id_user = $_SESSION['user']['id_user'];
    //         }
    //         $licence = new Licence(null, $description, $availability, $price, $type, $commisionning_date, $city, $id_user);
    //         $licence->addLicence();
    //         $this->redirectToRoute('/licence');
    //     }
    // }

    //CREER UNE METHODE

public function getAllLicence()
{
    $licence = new Licence(null,null,null,null,null,null,null,null);
    $myLicences = $licence->getAllLicence();
    require_once(__DIR__ . "/../Views/Licence/licence.view.php");     
}

    public function getLicenceById(){
        if(isset($GET['id'])){
            $idLicence = $_GET['id'];
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();
            if(!$licence){
                $this->redirectToRoute('/');
            }
        }
    }
    public function getLicenceByxId()
{
    // Vérifie que l'ID est bien présent dans l'URL
    if (isset($_GET['id'])) {
        $idLicence = $_GET['id'];

        // Crée une instance de Licence avec uniquement l'ID
        $licence = new Licence($idLicence, null, null, null, null, null, null, null);

        // Récupère la licence depuis la base de données
        $myLicence = $licence->getLicenceById();

        // Si aucune licence n'est trouvée, on redirige vers la page d'accueil
        if (!$myLicence) {
            $this->redirectToRoute('/');
        }

    }
}

    //  public function addKidTask()
    //     {
    //         if (isset($_GET['id'])) {
    //             //on met l'id de la tache dans une variable
    //             $idTask = $_GET['id'];
    //             //on instancie une nouvelle tache avec l'id de la tache
    //             $task = new Task($idTask, null, null, null, null, null, null, null, null, null, null);
    //             //on appelle la méthode pour aller chercher la tache dans la BDD on met le resulat dans la variable
    //             $myTask = $task->getTaskById();

    //             $user = new User(null, null, null, null, null, null);
    //             $myKids = $user->getKids();

    //             if (!$myTask) {
    //                 $this->redirectToRoute('/');
    //             }

    //             if (isset($_POST['kid'])) {
    //                 $idKid = htmlspecialchars($_POST['kid']);
    //                 $status = htmlspecialchars($_POST['status']);

    //                 $this->checkFormat('kid', $idKid);
    //                 $this->checkFormat('status', $status);

    //                 if (empty($this->arrayError)) {
    //                     $task = new Task($idTask, null, null, null, null, null, null, null, $status, null, $idKid);
    //                     $task->addTodo();
    //                     $this->redirectToRoute('/');
    //                 }
    //             }

    public function deleteLicence()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            echo "<script>var permissionMessage = 'Vous n\'avez pas les permissions pour supprimer cette licence.';</script>";
            return;
        }

        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null, null, null);
            $licence->deleteLicence();
            $_SESSION['successMessage'] = "Licence supprimée avec succès.";
            $this->redirectToRoute('/licenceUser');
        }
    }



    public function updateLicence()
    {
        // if (!isset($_SESSION['user_id'])) {
        //     header("Location: /login");
        //     exit();
        // }

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
        //     $description = htmlspecialchars(trim($_POST['description'] ?? ''), ENT_QUOTES, 'UTF-8');
        //     $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        //     $availability = filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_NUMBER_INT);

        //     $licence = (new Licence($id, '', '', 0, '', 0, 0, 0, 0, 0))->getLicenceById();


        //     $licence = new Licence($id, $description, $availability, $price, $type, $commissioning_date, $city,  $_SESSION['user_id']);
        //     if ($licence->updateLicence()) {
        //         header('Location: /licence');
        //         exit();
        //     }
        // }

        // require_once(__DIR__ . '/../Views/Licence/editLicence.view.php');
    }
}

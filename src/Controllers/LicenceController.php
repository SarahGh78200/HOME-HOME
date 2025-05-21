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

    public function addLicence()
    {
        //AJOUTE LES COMMENTAIRE
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['idRole'])) {
            $this->redirectToRoute('/');
        }
        if (isset($_POST['type'])) {
            $this->check('description', $_POST['description']);
            $this->check('price', $_POST['price']);
            $this->check('type', $_POST['type']);
            $this->check('commissioning_date', $_POST['commissioning_date']);
            $this->check('city', $_POST['city']);
            
          
            if (empty($this->arrayError)) {
                // htmlspecialchars permet l'execution de script malveillant    
                $description = htmlspecialchars($_POST['description']);
                $price = htmlspecialchars($_POST['price']);
                $type = htmlspecialchars($_POST['type']);
                $commissioning_date = date('Y-m-d H:i:s'); // <— corrigé
                $city = htmlspecialchars($_POST['city']);
                $id_user = $_SESSION['user']['idUser'];
               
                //J'instancie une classe
                $licence = new Licence( null,$description, null, $price, $type, $commissioning_date, $city,$id_user,null);
                $licence->addLicence();
                $this->redirectToRoute('/addLicence');
            }
        }

        require_once(__DIR__ . "/../Views/Licence/addLicence.view.php");
    }





    //CREER UNE METHODE

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
    }



            public function editLicence()
        {       
    if (isset($_GET['id'])) {
        $id = (int) $_GET['id'];

        // Récupère la licence par ID
        $licence = new Licence($id, null, null, null, null, null, null, null, null);
        $licence = $licence->getLicenceById(); // Tu dois avoir cette méthode dans ta classe Licence

        if (!$licence) {
            $this->redirectToRoute('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = htmlspecialchars($_POST['description']);
            $price = (float) $_POST['price'];
            $availability = isset($_POST['availability']) ? 1 : 0;
            $type = htmlspecialchars($_POST['type']);
            $commissioning_date = htmlspecialchars($_POST['commissioning_date']);
            $city = htmlspecialchars($_POST['city']);
            $id_user = (int) $_POST['id_user']; // Vérifie bien que ce champ est transmis
            $email = htmlspecialchars($_POST['email']);

            $updatedLicence = new Licence($id, $description, $availability, $price, $type, $commissioning_date, $city, $id_user, $email);
            $updatedLicence->update(); // Tu dois avoir une méthode `update()` dans ta classe Licence

            $this->redirectToRoute('/mesLicences');
        }

        require_once(__DIR__ . '/../Views/Licence/editLicence.view.php');
    } else {
        $this->redirectToRoute('/');
    }
}




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



//     public function updateLicence()
//     {
//         // if (!isset($_SESSION['user_id'])) {
//         //     header("Location: /login");
//         //     exit();
//         // }

//         // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//         //     $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
//         //     $description = htmlspecialchars(trim($_POST['description'] ?? ''), ENT_QUOTES, 'UTF-8');
//         //     $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
//         //     $availability = filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_NUMBER_INT);

//         //     $licence = (new Licence($id, '', '', 0, '', 0, 0, 0, 0, 0))->getLicenceById();


//         //     $licence = new Licence($id, $description, $availability, $price, $type, $commissioning_date, $city,  $_SESSION['user_id']);
//         //     if ($licence->updateLicence()) {
//         //         header('Location: /licence');
//         //         exit();
//         //     }
//         // }

//         // require_once(__DIR__ . '/../Views/Licence/editLicence.view.php');
//     }
// }
}
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
            $licence = new Licence($idLicence, null, null, null, null, null, null);
            $myLicence = $licence->getLicenceById();

            if (!$myLicence) {
                $this->redirectToRoute('/');
            }

            $idUser = $myLicence->getIdUser();
            $user = new User($idUser, null, null, null, null, null, null);

            require_once(__DIR__ . "/../Views/licence/licence.view.php");
        } else {
            $this->redirectToRoute('/');
        }
    }

    public function addLicence()
    {
        if (!isset($_SESSION['user']) || empty($_SESSION['user']['idRole'])) {
            $this->redirectToRoute('/');
        }

        $errors = [];
        $title = '';
        $description = '';
        $price = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars(trim($_POST['title'] ?? ''));
            $description = htmlspecialchars(trim($_POST['description'] ?? ''));
            $price = htmlspecialchars(trim($_POST['price'] ?? ''));
            $id_user = $_SESSION['user']['idUser'];

            // Vérifie si le champ 'title' est vide OU que sa longueur est inférieure à 4 caractères OU supérieure à 100 caractères
            if (empty($title) || strlen($title) < 4 || strlen($title) > 100) {
                // Si l'une des conditions est vraie, on ajoute une erreur dans le tableau $errors
                $errors['title'] = "Le titre doit avoir entre 4 et 100 caractères.";
            }

            if (empty($description) || strlen($description) < 4 || strlen($description) > 500) {
                $errors['description'] = "La description doit avoir entre 4 et 500 caractères.";
            }
            if (!is_numeric($price) || $price < 2) {
                $errors['price'] = "Le prix doit être un nombre supérieur ou égal à 2.";
            }

            if (empty($errors)) {
                $licence = new Licence(null, $title, $description, 1, null, $price, $id_user);
                if ($licence->addLicence()) {
                    $_SESSION['successMessage'] = "Licence ajoutée avec succès !";
                    $this->redirectToRoute('/addLicence');
                } else {
                    $errors['database'] = "Une erreur est survenue lors de l'ajout de la licence.";
                }
            }
        }

        require_once(__DIR__ . '/../Views/Licence/addLicence.view.php');
    }

    public function readLicence()
    {
        $licences = Licence::readLicence();
        $isLoggedIn = isset($_SESSION['user']);

        require_once(__DIR__ . '/../Views/licence/licence.view.php');
    }

    public function deleteLicence()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            echo "<script>var permissionMessage = 'Vous n\'avez pas les permissions pour supprimer cette licence.';</script>";
            return;
        }

        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null);
            $licence->deleteLicence();
            $_SESSION['successMessage'] = "Licence supprimée avec succès.";
            $this->redirectToRoute('/licenceUser');
        }
    }

    public function showLicence()
    {
        if (!isset($_GET['id'])) {
            $this->redirectToRoute('/licence');
            return;
        }

        $idLicence = htmlspecialchars($_GET['id']);
        $licence = new Licence($idLicence, null, null, null, null, null, null);
        $myLicence = $licence->getLicenceById();

        if (!$myLicence) {
            $_SESSION['errorMessage'] = "Licence introuvable.";
            $this->redirectToRoute('/licence');
            return;
        }

        require_once(__DIR__ . "/../Views/licence/detailLicence.view.php");
    }

    public function viewLicenceDetail()
    {
        if (!isset($_GET['id'])) {
            $this->redirectToRoute('/404');
        }

        $idLicence = htmlspecialchars($_GET['id']);
        $licence = new Licence($idLicence, null, null, null, null, null, null);
        $myLicence = $licence->getLicenceById();

        if (!$myLicence) {
            $this->redirectToRoute('/404');
        }

        $idUser = $myLicence->getIdUser();
        $user = new User($idUser, null, null, null, null, null, null);
        $userInfo = $user->getUserById($idUser);

        require_once(__DIR__ . "/../Views/licence/licenceDetail.view.php");
    }

    public function updateLicence()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            $title = htmlspecialchars(trim($_POST['title'] ?? ''), ENT_QUOTES, 'UTF-8');
            $description = htmlspecialchars(trim($_POST['description'] ?? ''), ENT_QUOTES, 'UTF-8');
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $availability = filter_input(INPUT_POST, 'availability', FILTER_SANITIZE_NUMBER_INT);

            $licence = (new Licence($id, '', '', 0, '', 0, 0))->getLicenceById();
            $picture = $licence ? $licence->getPicture() : null;

            $licence = new Licence($id, $title, $description, $availability, $picture, $price, $_SESSION['user_id']);
            if ($licence->updateLicence()) {
                header('Location: /licence');
                exit();
            }
        }

        require_once(__DIR__ . '/../Views/Licence/editLicence.view.php');
    }

    public function editLicence()
    {
        if (!isset($_SESSION['user'])) {
            $this->redirectToRoute('/login');
            return;
        }

        $idLicence = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
        $licence = ($idLicence) ? (new Licence($idLicence, null, null, null, null, null, null))->getLicenceById() : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = (float)($_POST['price'] ?? 0);
            $availability = isset($_POST['availability']) ? 1 : 0;

            $picture = $licence ? $licence->getPicture() : null;

            if ($title && $description && $price > 0) {
                $licence = new Licence($idLicence, $title, $description, $availability, $picture, $price, $_SESSION['user']['idUser']);
                $licence->updateLicence();
                $_SESSION['successMessage'] = "Licence mise à jour avec succès !";
                $this->redirectToRoute('/licenceUser');
                return;
            } else {
                $_SESSION['formErrors'] = ["Tous les champs sont obligatoires et le prix doit être supérieur à 0."];
            }
        }

        require_once(__DIR__ . '/../Views/Licence/editLicence.view.php');
    }
}

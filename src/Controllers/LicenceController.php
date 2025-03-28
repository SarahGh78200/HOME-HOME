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
            $picture = $_FILES['picture'] ?? null;
            $id_user = $_SESSION['user']['idUser'];
    
            // Validation des champs
            if (empty($title) || strlen($title) < 4 || strlen($title) > 100) {
                $errors['title'] = "Le titre doit avoir entre 4 et 100 caractères.";
            }
            if (empty($description) || strlen($description) < 4 || strlen($description) > 500) {
                $errors['description'] = "La description doit avoir entre 4 et 500 caractères.";
            }
            if (!is_numeric($price) || $price < 2) {
                $errors['price'] = "Le prix doit être un nombre supérieur ou égal à 2.";
            }
    
            // Validation du fichier image
            if (empty($picture['name'])) {
                $errors['picture'] = "L'image est obligatoire.";
            } else {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $maxFileSize = 2 * 1024 * 1024; // 2 Mo
    
                if (!in_array($picture['type'], $allowedTypes)) {
                    $errors['picture'] = "Le fichier doit être une image (JPEG, PNG ou GIF).";
                } elseif ($picture['size'] > $maxFileSize) {
                    $errors['picture'] = "Le fichier ne doit pas dépasser 2 Mo.";
                } else {
                    $uploadDir = __DIR__ . '/../../public/imgUpload/';
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0755, true);
                    }
    
                    // Générer un nom de fichier unique
                    $pictureName = uniqid() . '_' . basename($picture['name']);
                    $uploadFile = $uploadDir . $pictureName;
    
                    // Déplacer le fichier téléversé
                    if (move_uploaded_file($picture['tmp_name'], $uploadFile)) {
                        $picture = $pictureName; // Stocker le nom du fichier
                    } else {
                        $errors['picture'] = "Erreur lors du téléversement de l'image.";
                    }
                }
            }
    
            // Si aucune erreur, ajouter la licence
            if (empty($errors)) {
                $licence = new Licence(null, $title, $description, 1, $picture, $price, $id_user); // `availability` fixé à 1
                if ($licence->addLicence()) {
                    $_SESSION['successMessage'] = "Licence ajoutée avec succès !";
                    $this->redirectToRoute('/licence');
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

    // Récupérer les infos de l'utilisateur sans afficher l'ID
    $idUser = $myLicence->getIdUser();
    $user = new User($idUser, null, null, null, null, null, null);
    $userInfo = $user->getUserById($idUser); // Récupère nom et email sans afficher l'ID

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
        $picture = $licence ? $licence->getPicture() : 'default.jpg';

        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === 0) {
            $targetDirectory = $_SERVER['DOCUMENT_ROOT'] . '/public/imgUpload/';
            if (!is_dir($targetDirectory)) {
                mkdir($targetDirectory, 0755, true);
            }

            $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
            $pictureName = uniqid() . '.' . $extension;
            $targetFile = $targetDirectory . $pictureName;

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile)) {
                $picture = $pictureName;
            }
        }

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
    // Vérification de l'authentification
    if (!isset($_SESSION['user'])) {
        $this->redirectToRoute('/login');
        return;
    }

    $idLicence = (int)($_GET['id'] ?? $_POST['id'] ?? 0);
    $licence = ($idLicence) ? (new Licence($idLicence, null, null, null, null, null, null))->getLicenceById() : null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $price = (float)($_POST['price'] ?? 0);

        // Vérification et modification de la disponibilité
        $availability = isset($_POST['availability']) ? 1 : 0; // Si la case est cochée, disponibilité à 1 sinon 0

        // Gestion de l'image téléversée
        $uploadedPicture = $this->uploadPicture();
        $picture = $uploadedPicture ? $uploadedPicture : $licence->getPicture();

        if ($title && $description && $price > 0) {
            // Mise à jour de la licence avec la nouvelle disponibilité
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

private function uploadPicture(): ?string
{
    $picture = $_FILES['picture'] ?? null;

    if ($picture && $picture['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2 Mo
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/public/imgUpload/'; // Chemin du dossier

        // Vérifier le type MIME
        if (!in_array($picture['type'], $allowedTypes)) {
            $_SESSION['formErrors'][] = "Le fichier doit être une image de type JPEG, PNG ou GIF.";
            return null;
        }

        // Vérifier la taille du fichier
        if ($picture['size'] > $maxFileSize) {
            $_SESSION['formErrors'][] = "La taille de l'image ne doit pas dépasser 2 Mo.";
            return null;
        }

        // Créer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Générer un nom unique pour l'image
        $extension = pathinfo($picture['name'], PATHINFO_EXTENSION);
        $pictureName = uniqid() . '.' . $extension;
        $uploadFile = $uploadDir . $pictureName;

        // Déplacer l'image téléversée dans le dossier
        if (move_uploaded_file($picture['tmp_name'], $uploadFile)) {
            return $pictureName; // Retourner le nom de l'image en cas de succès
        } else {
            $_SESSION['formErrors'][] = "Erreur lors du téléversement de l'image.";
        }
    }

    return null; // Retourner null en cas d'échec
}
public function showContactVendeur()
{
    $licenceId = $_GET['licenceId'] ?? null; // Récupérer l'ID de la licence de l'URL
    if (!$licenceId) {
        // Gérer le cas où l'ID de la licence est manquant
        header("Location: /");
        exit;
    }

    // Récupérer la licence et les informations du vendeur
    $licence = Licence::findById($licenceId); // Trouver la licence
    $userInfo = (new User())->getUserByLicenceId($licenceId); // Trouver les infos du vendeur

    // Vérifier si les données existent
    if (!$licence || !$userInfo) {
        header("Location: /"); // Si la licence ou le vendeur n'existe pas
        exit;
    }

    // Passer les données à la vue
    require_once(__DIR__ . '/../views/contactVendeur.php');
}



}


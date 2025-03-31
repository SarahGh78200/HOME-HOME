<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;

class UserController extends AbstractController
{
    public function profil()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $user = User::findByEmail($_SESSION['user']['email']);

        if (!$user) {
            die("Utilisateur non trouvé !");
        }

        require_once __DIR__ . "/../Views/User/profile.view.php";
    }

    public function mesLicences()
    {
        if (!isset($_SESSION['user']) || !$_SESSION['user']['idRole']) {
            header('Location: /login');
            exit();
        }

        $user = User::findByEmail($_SESSION['user']['email']);
        if (!$user) {
            die("Utilisateur non trouvé !");
        }

        $licences = $user->getLicences();

        require_once __DIR__ . "/../Views/User/licenceUser.views.php";
    }

    public function editProfilUser() {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
    
        // Trouver l'utilisateur à partir de l'email dans la session
        $user = User::findByEmail($_SESSION['user']['email']);
        if (!$user) {
            $errorMessage = "Utilisateur non trouvé.";
            require __DIR__ . '/../Views/User/editProfilUser.view.php';
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupération des données du formulaire, avec valeur par défaut pour chaque champ
            $surname = trim($_POST['surname'] ?? $user->getSurname());
            $name = trim($_POST['name'] ?? $user->getName());
            $birthDate = $_POST['birth_date'] ?? $user->getBirthDate(); // Si non modifié, garder l'ancien
            $email = trim($_POST['email'] ?? $user->getEmail());
    
            // Garder l'ancien mot de passe si non modifié
            $password = $_POST['password'] ?? ''; // Pas de modification de mot de passe
    
            $idRole = $user->getId_Role(); // Garder le même rôle
    
            // Si l'email a changé, il faut vérifier si ce nouvel email est déjà pris
            if ($email !== $user->getEmail() && User::findByEmail($email)) {
                $errorMessage = "Cet email est déjà utilisé.";
            } else {
                // Mise à jour des champs
                $updateSuccess = $user->updateUser(
                    $user->getId(),
                    $surname,
                    $name,
                    $birthDate,
                    $email,
                    empty($password) ? $user->getPassword() : password_hash($password, PASSWORD_DEFAULT), // Si mot de passe vide, garder l'ancien
                    $idRole
                );
    
                if ($updateSuccess) {
                    // Mettre à jour l'email dans la session si changé
                    $_SESSION['user']['email'] = $email;
    
                    // Si le mot de passe est modifié, mettre à jour dans la session
                    if (!empty($password)) {
                        $_SESSION['user']['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }
    
                    // Redirection après la mise à jour
                    header("Location: /profil?success=1");
                    exit();
                } else {
                    $errorMessage = "Erreur lors de la mise à jour.";
                }
            }
        }
    
        // Affichage de la vue avec les erreurs possibles et les données
        require __DIR__ . '/../Views/User/editProfilUser.view.php';
    }
    
    public function editLicenceUser() {
        // Vérification si l'utilisateur est connecté
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
    
        // Trouver l'utilisateur à partir de l'email dans la session
        $user = User::findByEmail($_SESSION['user']['email']);
        if (!$user) {
            $errorMessage = "Utilisateur non trouvé.";
            require __DIR__ . '/../Views/User/editProfilUser.view.php';
            return;
        }
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Récupération des données du formulaire, avec valeur par défaut pour chaque champ
            $surname = trim($_POST['surname'] ?? $user->getSurname());
            $name = trim($_POST['name'] ?? $user->getName());
            $birthDate = $_POST['birth_date'] ?? $user->getBirthDate(); // Si non modifié, garder l'ancien
            $email = trim($_POST['email'] ?? $user->getEmail());
    
            // Garder l'ancien mot de passe si non modifié
            $password = $_POST['password'] ?? ''; // Pas de modification de mot de passe
    
            $idRole = $user->getId_Role(); // Garder le même rôle
    
            // Si l'email a changé, il faut vérifier si ce nouvel email est déjà pris
            if ($email !== $user->getEmail() && User::findByEmail($email)) {
                $errorMessage = "Cet email est déjà utilisé.";
            } else {
                // Mise à jour des champs
                $updateSuccess = $user->updateUser(
                    $user->getId(),
                    $surname,
                    $name,
                    $birthDate,
                    $email,
                    empty($password) ? $user->getPassword() : password_hash($password, PASSWORD_DEFAULT), // Si mot de passe vide, garder l'ancien
                    $idRole
                );
    
                if ($updateSuccess) {
                    // Mettre à jour l'email dans la session si changé
                    $_SESSION['user']['email'] = $email;
    
                    // Si le mot de passe est modifié, mettre à jour dans la session
                    if (!empty($password)) {
                        $_SESSION['user']['password'] = password_hash($password, PASSWORD_DEFAULT);
                    }
    
                    // Redirection après la mise à jour
                    header("Location: /profil?success=1");
                    exit();
                } else {
                    $errorMessage = "Erreur lors de la mise à jour.";
                }
            }
        }
    
        // Affichage de la vue avec les erreurs possibles et les données
        require __DIR__ . '/../Views/User/editProfilUser.view.php';
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
    
    public function envoyerMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit();
        }
    
        $vendeurId = $_POST['vendeur_id'];
        $message = trim($_POST['message']);
        
        // Ici vous pourriez:
        // 1. Envoyer un email au vendeur
        // 2. Sauvegarder le message en BDD
        // 3. Rediriger avec un message de succès
        
        $_SESSION['success'] = "Votre message a été envoyé !";
        header('Location: /licenceDetail?id=' . $_POST['licence_id']);
        exit();
    }
    // src/Controllers/UserController.php
public function contactVendeur(int $licenceId) {
    // 1. Récupérer la licence et le vendeur
    $licence = Licence::findById($licenceId);
    if (!$licence) {
        header("Location: /erreur?message=Licence non trouvée");
        exit();
    }

    $vendeur = User::findById($licence->getUserId());
    
    // 2. Afficher la vue
    require_once __DIR__ . '/../Views/User/contactVendeur.view.php';
}


}

<?php

// Déclaration du namespace (emplacement du fichier dans l’architecture du projet)
namespace App\Controllers;

// Importation de la classe de base des contrôleurs et du modèle User
use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    // Méthode appelée pour afficher ou traiter l'inscription
    public function index()
    {
        // Vérifie si les champs du formulaire ont été soumis
        if (isset($_POST['name'], $_POST['surname'], $_POST['birth_date'], $_POST['password'], $_POST['email'])) {
            // Vérifie chaque champ avec une méthode de validation personnalisée
            $this->check('name', $_POST['name']);
            $this->check('surname', $_POST['surname']);
            $this->check('birth_date', $_POST['birth_date']);
            $this->check('password', $_POST['password']);
            $this->check('email', $_POST['email']);

            // Si aucune erreur n’a été trouvée, on continue
            if (empty($this->arrayError)) {
                // Protection contre les injections avec htmlspecialchars
                $name = htmlspecialchars($_POST['name']);
                $surname = htmlspecialchars($_POST['surname']);
                $birth_date = htmlspecialchars($_POST['birth_date']);

                // Nettoyage et filtrage de l'email
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

                // Hash du mot de passe pour la sécurité
                $password = htmlspecialchars($_POST['password']);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Date actuelle d'inscription
                $register_date = date('Y-m-d');

                // ID du rôle par défaut (par exemple : 2 = utilisateur simple)
                $id_role = 2;

                // Création de l’objet User avec les données du formulaire
                $user = new User(
                    null,              
                    $name,              
                    $surname,           
                    $birth_date,        
                    $passwordHash,      
                    $register_date,     
                    $id_role,           
                    $email              
                );

                // Sauvegarde du nouvel utilisateur en base de données
                $user->save();

                // Redirection vers la page d’accueil après inscription réussie
                $this->redirectToRoute('/');
            }
        }

        // Si le formulaire n’est pas soumis ou s’il y a des erreurs, afficher la vue d'inscription
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}

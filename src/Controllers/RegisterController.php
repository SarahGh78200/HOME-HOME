<?php  
namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class RegisterController extends AbstractController
{
    private array $errors = []; // Déclaration correcte des erreurs

    public function index()
    {
        if (isset($_POST['surname'], $_POST['name'], $_POST['birth_date'], $_POST['password'], $_POST['email'])) {
            // Validation des champs
            $this->check('email', $_POST['email']);
            $this->check('name', $_POST['name']);
            $this->check('surname', $_POST['surname']);
            $this->check('password', $_POST['password']);
    
            if (empty($this->errors)) {  // Correction : utiliser $this->errors au lieu de $this->arrayError
                $name = htmlspecialchars($_POST['name']);
                $surname = htmlspecialchars($_POST['surname']);
                $birth_date = htmlspecialchars($_POST['birth_date']);
                $password = htmlspecialchars($_POST['password']);
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $id_role = 2; // Rôle "Client" par défaut
    
                // Vérification si l'email existe déjà
                if (User::findByEmail($email)) {
                    $this->errors['email'] = "Cette adresse e-mail est déjà utilisée.";
                }
    
                // Vérification de l'âge
                $birthDate = new \DateTime($birth_date);
                $currentDate = new \DateTime();
                $age = $currentDate->diff($birthDate)->y;
    
                if ($age < 18) {
                    $this->errors['birth_date'] = "Vous devez avoir au moins 18 ans pour vous inscrire.";
                }
    
                if (empty($this->errors)) {
                    $user = new User(null, $surname, $name, $birth_date, $passwordHash, $id_role, $email);
                    if ($user->save()) {
                        $this->redirectToRoute('/');
                    } else {
                        $this->errors['global'] = "Erreur lors de l'enregistrement.";
                    }
                }
            }
        }
    
        // Transmission des erreurs à la vue
        $errors = $this->errors;
        require_once(__DIR__ . "/../Views/security/register.view.php");
    }
}
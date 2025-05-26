<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\User;

class LoginController extends AbstractController
{
    public function index()
    {
        if (isset($_POST['email'], $_POST['password'])) {
            $this->check('email', $_POST['email']);
            $this->check('password', $_POST['password']);

            if (empty($this->arrayError)) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                // Création d’un objet User juste pour appeler la méthode login
                $user = new User(null, null, null, null, $password, null, null, $email);
                $responseGetUser = $user->login($email);

                if ($responseGetUser) {
                    $passwordUser = $responseGetUser->getPassword();

                    if (password_verify($password, $passwordUser)) {
                        $_SESSION['user'] = [
                            'id'      => uniqid(),
                            'email'   => $responseGetUser->getEmail(),
                            'name'    => $responseGetUser->getName(),
                            'surname' => $responseGetUser->getSurname(),
                            'idUser'  => $responseGetUser->getId(),
                            'idRole'  => $responseGetUser->getIdRole()
                        ];
                        $this->redirectToRoute('/');
                    } else {
                        $error = "Email ou mot de passe incorrect.";
                    }
                } else {
                    $error = "Email ou mot de passe incorrect.";
                }
            }
        }

        if (isset($_SESSION['user'])) {
            $this->redirectToRoute('/');
        }

        require_once(__DIR__ . "/../Views/security/login.view.php");
    }
}

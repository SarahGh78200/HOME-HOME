<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;
use App\Models\User;
class AdminController extends AbstractController
{
  public function deleteLicence()
    {

        if (isset($_POST['id'])) {
            $idLicence = htmlspecialchars($_POST['id']);
            $licence = new Licence($idLicence, null, null, null, null, null, null,null, null);
            $licence->deleteLicence();
            $this->redirectToRoute('/dashboard');
        }
    }
      public function deleteUser()
    {

        if (isset($_POST['id'])) {
            $idUser = htmlspecialchars($_POST['id']);
            $user = new User($idUser, null, null, null, null, null, null, null, null);
            $user->deleteUser();
            $this->redirectToRoute('/dashboard');
        }
    }


    
}

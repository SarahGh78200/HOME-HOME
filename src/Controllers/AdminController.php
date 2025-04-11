<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Licence;

class AdminController
{
    public function dashboard()
    {
        $users = User::findAll();
        $licences = Licence::findAll();

        $editUser = isset($_GET['editUser']) ? User::findById((int)$_GET['editUser']) : null;
        $editLicence = isset($_GET['editLicence']) ? Licence::findById((int)$_GET['editLicence']) : null;

        require_once __DIR__ . '/../Views/Admin/dashboard.view.php';
    }

    public function deleteUser()
    {
        if (isset($_GET['id'])) {
            $user = new User((int)$_GET['id'], null, null, null, null, null, null);
            $user->deleteUser();
            header("Location: /admin/dashboard");
            exit;
        }
    }

    public function deleteLicence()
    {
        if (isset($_GET['id'])) {
            $licence = new Licence((int)$_GET['id'], null, null, null, null, null, null);
            $licence->deleteLicence();
            header("Location: /admin/dashboard");
            exit;
        }
    }
}

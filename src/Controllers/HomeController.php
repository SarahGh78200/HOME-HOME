<?php

namespace App\Controllers;

use App\Utils\AbstractController;
use App\Models\Licence;

class HomeController extends AbstractController
{
    public function index()
    {
    

        require_once(__DIR__ . '/../Views/home.view.php');
    }
}

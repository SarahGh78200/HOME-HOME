<?php
session_start();
require "vendor/autoload.php";

use App\Controllers\LicenceController;
use Config\Router;

$router = new Router();

// Page d'accueil
$router->addRoute('/', 'HomeController', 'index');

// Connexion/Déconnexion & Inscription
$router->addRoute('/register', 'RegisterController', 'index');
$router->addRoute('/login', 'LoginController', 'index');
$router->addRoute('/logout', 'LogoutController', 'logout');

// Profil utilisateur
$router->addRoute('/profil', 'UserController', 'profil');
$router->addRoute('/licenceUser', 'UserController', 'mesLicences');
$router->addRoute('/editProfilUser', 'UserController', 'editProfilUser');

// Détails des licences
$router->addRoute('/licenceDetails', 'LicenceController', 'showLicence');
$router->addRoute('/licenceDetail', 'LicenceController', 'viewLicenceDetail');

// Gestion des licences
$router->addRoute('/addLicence', 'LicenceController', 'addLicence');
$router->addRoute('/licence', 'LicenceController', 'readLicence');
$router->addRoute('/editLicence', 'LicenceController', 'editLicence');
$router->addRoute('/updateLicence', 'LicenceController', 'updateLicence'); // Ajout de la route manquante
$router->addRoute('/deleteLicence', 'LicenceController', 'deleteLicence');
// Ajoute cette route pour la page Contact Vendeur
// $router->addRoute('/contactVendeur', 'UserController', 'Voirprofil');
// // $router->addRoute('/contactVendeur/:id', 'UserController', 'voirProfil');
// $router->addRoute('/contactVendeur/:id', 'UserController', 'profil');
$router->addRoute('/contact-vendeur/:licenceId', 'UserController', 'contactVendeur');
$router->addRoute('/contact-vendeur/:id', 'UserController', 'contactVendeur');
$router->addRoute('/contact', 'ContactController', 'index');

$router->handleRequest();

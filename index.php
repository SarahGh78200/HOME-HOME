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
//CONTACT VENDEUR 
$router->addRoute('/contact-vendeur/:licenceId', 'UserController', 'contactVendeur');
$router->addRoute('/contact-vendeur/:id', 'UserController', 'contactVendeur');
//CONTACT ADMIN 
$router->addRoute('/contact', 'ContactController', 'index');
// $router->addRoute('/admin', 'UserController', 'dashboardAdmin');
// Dashboard Admin complet
$router->addRoute('/admin/dashboard', 'AdminController', 'dashboard');

// Supprimer un utilisateur
$router->addRoute('/admin/deleteUser', 'AdminController', 'deleteUser');

// Supprimer une licence
$router->addRoute('/admin/deleteLicence', 'AdminController', 'deleteLicence');

$router->handleRequest();

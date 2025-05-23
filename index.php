<?php
session_start();
require "vendor/autoload.php";

use App\Controllers\LicenceController;
use Config\Router;

$router = new Router();

// Page d'accueil
$router->addRoute('/', 'HomeController', 'index');

// Connexion/Déconnexion & Inscription
$router->addRoute('/register', 'RegisterController', 'index');//FONCTIONNE
$router->addRoute('/login', 'LoginController', 'index');//FONCTIONNE
$router->addRoute('/logout', 'LogoutController', 'logout');//FONCTIONNE

// Profil utilisateur
$router->addRoute('/profil', 'UserController', 'profil');//FONCTIONNE
$router->addRoute('/licenceUser', 'UserController', 'mesLicences');//FONCTIONNE
$router->addRoute('/editProfilUser', 'UserController', 'editProfilUser');//FONCTIONNE

// Détails des licences
$router->addRoute('/licenceDetailById', 'LicenceController', 'getLicenceById');//FONCTIONNE

// Gestion des licences
$router->addRoute('/addLicence', 'LicenceController', 'addLicence');//FONCTIONNE
$router->addRoute('/getAllLicence','LicenceController','getAllLicence');//FONCTIONNE
// $router->addRoute('/licence', 'LicenceController', 'readLicence');
$router->addRoute('/editLicence', 'LicenceController', 'editLicence');//FONCTIONNE
$router->addRoute('/updateLicence', 'LicenceController', 'updateLicenceUser'); // Ajout de la route manquante
$router->addRoute('/deleteLicence', 'LicenceController', 'deleteLicence');//FONCTIONNE
//CONTACT VENDEUR 
$router->addRoute('/contact-vendeur/:licenceId', 'UserController', 'contactVendeur');
$router->addRoute('/contact-vendeur/:id', 'UserController', 'contactVendeur');
//CONTACT ADMIN 
$router->addRoute('/contact', 'ContactController', 'index');

// $router->addRoute('/admin', 'UserController', 'dashboardAdmin');
// Dashboard Admin complet
$router->addRoute('/dashboard', 'UserController', 'dashboardGet');//FONCTIONNE

// Supprimer un utilisateur
$router->addRoute('/deleteUser', 'AdminController', 'deleteUser');// FONCTIONNE EN POST

// Supprimer une licence
$router->addRoute('deleteLicenceUser', 'AdminController', 'deleteLicence');//FONCTIONNE EN POST

$router->handleRequest();

<?php
require_once(__DIR__ . '/partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Free Moove Driver</title>
    <link rel="stylesheet" href="/public/css/homeController.css">
</head>
<body class="bodyController">

    <!-- Vidéo en background -->
    <video class="video-background" autoplay muted loop>
        <source src="/public/video/taxi-presentation.mp41.mp4" type="video/mp4">
        Votre navigateur ne supporte pas la lecture de vidéos.
    </video>

    <!-- Contenu avec fond semi-transparent -->
    <div class="content">
        <h1>Bonjour et bienvenue sur <span>Free Moove Driver</span> !</h1>
        <p>Votre plateforme de reconversion professionnelle dans le métier de taxi.</p>

        <!-- Illustration de la reconversion professionnelle -->
        <img src="/public/images/reconversion.jpg" alt="Illustration de reconversion professionnelle" class="small-img">
        
        <p>Rejoignez notre réseau de conducteurs et louez ou achetez une licence pour démarrer votre nouvelle carrière.</p>
        
        <!-- Image de la licence -->
        <img src="/public/images/licence-taxi.jpg" alt="Licence Taxi" class="small-img">
        
        <p>Simple, rapide et sécurisé. Devenez conducteur dès aujourd'hui !</p>
    </div>

</body>
</html>

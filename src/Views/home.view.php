<?php
require_once(__DIR__ . '/partials/head.php');
?>


<main class="bodyController">

    <!-- Vidéo en background -->
    <video class="video-background" autoplay muted loop>
        <source src="/public/video/taxi-presentation.mp4" type="video/mp4">
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

        <a href="/inscription" class="cta-button">Commencez votre reconversion</a>
    </div>

    <!-- Section Comment ça marche ? -->
    <section class="how-it-works">
        <h2>Comment ça marche ?</h2>
        <div class="steps">
            <div class="step">
                <h3>1. Inscrivez-vous</h3>
                <p>Créez votre compte en quelques clics.</p>
            </div>
            <div class="step">
                <h3>2. Trouvez une licence</h3>
                <p>Accédez à une liste de licences disponibles.</p>
            </div>
            <div class="step">
                <h3>3. Devenez taxi</h3>
                <p>Lancez-vous et démarrez votre activité en toute simplicité !</p>
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials">
        <h2>Ils ont réussi avec Free Moove</h2>
        <blockquote>
            <p>"Grâce à Free Moove, j’ai pu obtenir ma licence et démarrer ma carrière de chauffeur de taxi en moins d’un mois !"</p>
            <cite>– Karim B.</cite>
        </blockquote>
    </section>

    <!-- Section FAQ -->
    <section class="faq">
        <h2>Foire aux questions</h2>
        <details>
            <summary>Ai-je besoin d’un permis spécial pour devenir taxi ?</summary>
            <p>Oui, un permis B et une formation spécifique sont requis.</p>
        </details>
        <details>
            <summary>Comment fonctionne la location d’une licence ?</summary>
            <p>Vous pouvez louer une licence directement sur notre plateforme auprès d’un propriétaire.</p>
        </details>
    </section>
</main>
    <?php
 
 require_once __DIR__ . '/partials/footer.php';
    ?>

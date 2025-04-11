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
        <h1 class="titlehome">Bonjour et bienvenue sur <span>Free Moove Driver</span> !</h1>
        <p>Votre plateforme de reconversion professionnelle dans le métier de taxi.</p>

        
        <p>Rejoignez notre réseau de conducteurs et louez ou achetez une licence pour démarrer votre nouvelle carrière.</p>
        
 
        
        <p>Simple, rapide et sécurisé. Devenez conducteur dès aujourd'hui !</p>

        <a href="/src/Views/Reconvertion.views.php" class="cta-button">Commencez votre reconversion</a>
    </div>

    <!-- Section Comment ça marche ? -->
    <section class="how-it-works">
        <h2 class="titlehomeh2">🚀 Comment ça marche ?</h2>
        <div class="steps">
            <div class="step">
                <h3>1️⃣ Inscrivez-vous</h3>
                <p>Remplissez votre profil en quelques clics pour accéder à nos services personnalisés.</p>
            </div>
            <div class="step">
                <h3>2️⃣ Trouvez votre licence</h3>
                <p>Explorez notre catalogue de licences disponibles à la location ou à l’achat, dans votre région.</p>
            </div>
            <div class="step">
                <h3>3️⃣ Lancez votre activité</h3>
                <p>Nous vous guidons jusqu’au démarrage de votre nouvelle vie de conducteur. Simple et rapide.</p>
            </div>
        </div>
        <div class="action-center">
            <a href="/src/Views/Reconvertion.views.php" class="cta-button">Je commence maintenant</a>
        </div>
    </section>

    <!-- Section Témoignages -->
    <section class="testimonials">
        <h2 class="titlehomeh2">💬 Ils ont réussi avec Free Moove</h2>
        <div class="testimonial-list">
            <blockquote>
                <p>"Grâce à Free Moove, j’ai obtenu ma licence et commencé à travailler en moins d’un mois. Accompagnement au top."</p>
                <cite>– Karim B.</cite>
            </blockquote>
            <blockquote>
                <p>"La location de licence m’a permis de me lancer sans gros investissement. Une vraie opportunité de reconversion."</p>
                <cite>– Samira L.</cite>
            </blockquote>
        </div>
    </section>

    <!-- Section FAQ -->
    <section class="faq">
        <h2 class="titlehomeh2">❓ Foire aux questions</h2>
        <details>
            <summary>Ai-je besoin d’un permis spécial pour devenir taxi ?</summary>
            <p>Oui, le permis B est obligatoire, ainsi qu’une formation (CCPCT) et une carte professionnelle délivrée par la préfecture.</p>
        </details>
        <details>
            <summary>Comment fonctionne la location d’une licence ?</summary>
            <p>Nous mettons en relation les conducteurs avec des détenteurs de licences disponibles à la location sur toute la France.</p>
        </details>
        <details>
            <summary>Est-ce que Free Moove m’aide dans les démarches ?</summary>
            <p>Oui ! De l’inscription jusqu’au démarrage, on vous accompagne dans toutes les étapes administratives, techniques et légales.</p>
        </details>
    </section>

</main>
    <?php
 
 require_once __DIR__ . '/partials/footer.php';
    ?>

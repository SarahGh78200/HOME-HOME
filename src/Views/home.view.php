<?php require_once(__DIR__ . '/partials/head.php'); ?>

<main class="bodyController">



    <!-- Conteneur Flex -->
    <div class="hero-flex">
        <!-- Bloc 1 : Reconvertir -->
        <div class="content">
            <h1 class="titlehome">Reconversion professionnelle</h1>
            <p>Envie de changer de métier ? Découvrez comment devenir chauffeur de taxi grâce à notre accompagnement.</p>
            <p>Nous vous guidons pas à pas pour réussir votre reconversion : démarches, formations, financement, etc.</p>
            <p>Rejoignez une profession utile, humaine et dynamique !</p>
            <a href="/src/Views/reconvertion.views.php" class="cta-button">En savoir plus sur la reconversion</a>
        </div>

        <!-- Bloc 2 : Licences -->
        <div class="content">
            <h1 class="titlehome">Location ou vente de licences</h1>
            <p>Vous cherchez une licence de taxi pour démarrer votre activité ?</p>
            <p>Accédez à notre catalogue de licences disponibles à la location ou à la vente partout en France.</p>
            <p>Publiez ou trouvez une licence en quelques clics, en toute sécurité.</p>
            <a href="/getAllLicence" class="cta-button">Voir les licences disponibles</a>
        </div>
    </div>
</section>

<!-- 🧭 COMMENT ÇA MARCHE -->
<section class="how-it-works">
    <h2 class="titlehomeh2"> Comment ça marche ?</h2>
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

</main>

<?php require_once __DIR__ . '/partials/footer.php'; ?>

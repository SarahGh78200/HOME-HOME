<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/partials/head.php');
?>

<main class="bodyfaqCss">

    <div class="faq-container">
        <h2>Foire Aux Questions (FAQ)</h2>

        <div class="faq-item">
            <div class="faq-question">Comment puis-je louer une licence de taxi ? <span>+</span></div>
            <div class="faq-answer">Vous pouvez parcourir les licences disponibles sur notre site et contacter directement le propriétaire.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Puis-je acheter une licence de taxi sur votre site ? <span>+</span></div>
            <div class="faq-answer">Notre plateforme met en relation les acheteurs et les vendeurs de licences de taxi.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Quels documents sont nécessaires pour louer ou acheter une licence ? <span>+</span></div>
            <div class="faq-answer">Les documents requis incluent une carte professionnelle de taxi et un justificatif d’identité.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Comment devenir chauffeur de taxi ? <span>+</span></div>
            <div class="faq-answer">Vous devez suivre une formation, réussir l’examen du CCPCT et obtenir votre licence.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Comment créer un compte sur votre site ? <span>+</span></div>
            <div class="faq-answer">Cliquez sur "S'inscrire", remplissez les informations demandées et validez votre inscription.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Quels sont les moyens de paiement acceptés sur la plateforme ? <span>+</span></div>
            <div class="faq-answer">Nous acceptons les paiements par carte bancaire, virement et certaines plateformes de paiement en ligne.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Puis-je modifier ou annuler une location après réservation ? <span>+</span></div>
            <div class="faq-answer">Oui, selon les conditions définies par le propriétaire de la licence. Consultez les modalités avant toute réservation.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Y a-t-il des frais supplémentaires pour utiliser la plateforme ? <span>+</span></div>
            <div class="faq-answer">L’inscription est gratuite, mais des frais peuvent s’appliquer pour certaines transactions ou services premium.</div>
        </div>

        <div class="faq-item">
            <div class="faq-question">Comment contacter le support en cas de problème ? <span>+</span></div>
            <div class="faq-answer">Vous pouvez nous joindre via le formulaire de contact sur notre site ou par e-mail à [adresse support].</div>
        </div>

    </div>

    <script>
        document.querySelectorAll(".faq-question").forEach(item => {
            item.addEventListener("click", function() {
                let answer = this.nextElementSibling;
                let span = this.querySelector("span");
                if (answer.style.display === "block") {
                    answer.style.display = "none";
                    span.textContent = "+";
                } else {
                    answer.style.display = "block";
                    span.textContent = "-";
                }
            });
        });
    </script>

</main>

<?php
require_once __DIR__ . '/partials/footer.php';
?>



<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>FAQ - Location & Achat de Licences de Taxi</title>
<link rel="stylesheet" href="/public/css/faq.css">

</head
<body>

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
</body>

</html>
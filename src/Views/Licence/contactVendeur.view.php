
<div class="container">
    <h1>Contacter le vendeur</h1>
    
    <div class="vendeur-info">
        <h2><?= htmlspecialchars($vendeur->getName()) ?></h2>
        <p>Email: <?= htmlspecialchars($vendeur->getEmail()) ?></p>
        <!-- Ajoutez d'autres infos si besoin -->
    </div>

    <form action="/envoyer-message" method="POST">
        <input type="hidden" name="vendeur_id" value="<?= $vendeur->getId() ?>">
        <input type="hidden" name="licence_id" value="<?= $licence->getId() ?>">
        
        <div class="form-group">
            <label for="message">Votre message:</label>
            <textarea id="message" name="message" class="form-control" required></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
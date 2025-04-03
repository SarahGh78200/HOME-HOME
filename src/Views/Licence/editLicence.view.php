<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Édition de la Licence</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien vers notre CSS personnalisé -->
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Édition de la Licence</h2>
        
        <!-- Formulaire d'édition -->
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($licence->getTitle()) ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" class="form-control" rows="4" required><?= htmlspecialchars($licence->getDescription()) ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Prix :</label>
                <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($licence->getPrice()) ?>" min="0" step="0.01" required>
            </div>

            <!-- Disponibilité (checkbox) -->
            <div class="form-group form-check">
                <input type="checkbox" name="availability" id="availability" class="form-check-input" <?= $licence->getAvailability() ? 'checked' : '' ?>>
                <label class="form-check-label" for="availability">Licence disponible</label>
            </div>

            <div class="form-group">
                <label for="picture">Image :</label>
                <input type="file" name="picture" id="picture" class="form-control-file">
                <small class="form-text text-muted">Format d'image accepté : JPG, PNG, GIF</small>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Enregistrer les modifications</button>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS et jQuery (nécessaire pour certaines fonctionnalités) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
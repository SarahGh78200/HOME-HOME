<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<main class="addlicenceCSS">
    <h1 class="titleAddLicence">Ajouter une licence</h1>

    <!-- Messages d'erreur -->
    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
            <p>Le formulaire contient des erreurs. Veuillez les corriger.</p>
        </div>
    <?php } ?>

    <!-- Message de succès -->
    <?php if (isset($_SESSION['successMessage'])) { ?>
        <div class="alert alert-success">
            <p><?= htmlspecialchars($_SESSION['successMessage']) ?></p>
        </div>
        <?php unset($_SESSION['successMessage']); ?>
    <?php } ?>

    <!-- Formulaire -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form1 col-md-6 mx-auto mt-5">

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($description ?? '') ?></textarea>
                <?php if (!empty($errors['description'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['description']) ?></p>
                <?php } ?>
            </div>

            <!-- Prix -->
            <div class="mb-3">
                <label for="price" class="form-label">Prix (€)</label>
                <input type="number" class="form-control" id="price" name="price"
                    value="<?= htmlspecialchars($price ?? '') ?>" min="0" step="0.01" required>
                <?php if (!empty($errors['price'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['price']) ?></p>
                <?php } ?>
            </div>

            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="">-- Sélectionnez un type --</option>
                    <option value="location" <?= (isset($type) && $type === 'location') ? 'selected' : '' ?>>Location</option>
                    <option value="achat" <?= (isset($type) && $type === 'achat') ? 'selected' : '' ?>>Achat</option>
                </select>
                <?php if (!empty($errors['type'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['type']) ?></p>
                <?php } ?>
            </div>


            <!-- Date de mise en service -->
            <div class="mb-3">
                <label for="commissioning_date" class="form-label">Date de mise en service</label>
                <input type="date" class="form-control" id="commissioning_date" name="commissioning_date"
                    value="<?= htmlspecialchars($commissioning_date ?? '') ?>" required>
                <?php if (!empty($errors['commissioning_date'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['commissioning_date']) ?></p>
                <?php } ?>
            </div>

            <!-- Ville -->
            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city"
                    value="<?= htmlspecialchars($city ?? '') ?>" required>
                <?php if (!empty($errors['city'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['city']) ?></p>
                <?php } ?>
            </div>



            <!-- Bouton -->
            <div class="text-center mt-4">
                <button class="buttonAddLicence btn btn-primary" type="submit">Ajouter la licence</button>
            </div>

        </div>
    </form>
</main>

<?php
// Pied de page

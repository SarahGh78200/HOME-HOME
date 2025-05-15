<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<main class="addlicenceCSS">

    <h1 class="titleAddLicence">Ajouter une licence</h1>

    <!-- Affichage des messages de succès ou d'erreur -->
    <?php if (!empty($errors)) { ?>
        <div class="alert alert-danger">
            <p>Le formulaire contient des erreurs. Veuillez les corriger avant de soumettre à nouveau.</p>
        </div>
    <?php } ?>

    <?php if (isset($_SESSION['successMessage'])) { ?>
        <div class="alert alert-success">
            <p><?= htmlspecialchars($_SESSION['successMessage']) ?></p>
        </div>
        <?php unset($_SESSION['successMessage']); // Supprimer le message après affichage 
        ?>
    <?php } ?>

    <!-- Formulaire -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form1" class="col-md-4 mx-auto d-block mt-5">
      
          <!-- Champ Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" ><?= htmlspecialchars($description) ?></textarea>
                <?php if (isset($errors['description'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['description']) ?></p>
                <?php } ?>
            </div>

            <!-- Champ Prix -->
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($price) ?>" required min="2" step="1">
                <?php if (isset($errors['price'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['price']) ?></p>
                <?php } ?>
            </div>
              <!-- Champ type -->
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="number" class="form-control" id="type" name="type" value="<?= htmlspecialchars($type) ?>" required min="2" step="1">
                <?php if (isset($errors['type'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['type']) ?></p>
                <?php } ?>
            </div>
              <!-- Champ commissioning_date -->
            <div class="mb-3">
                <label for="commissioning_date" class="form-label">Date de mise en service</label>
                <input type="number" class="form-control" id="commissioning_date" name="commissioning_date" value="<?= htmlspecialchars($commissioning_date) ?>" required min="2" step="1">
                <?php if (isset($errors['commissioning_date'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['commissioning_date']) ?></p>
                <?php } ?>
            </div>
              <!-- Champ City -->
            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="number" class="form-control" id="city" name="city" value="<?= htmlspecialchars($city) ?>" required min="2" step="1">
                <?php if (isset($errors['city'])) { ?>
                    <p class="text-danger"><?= htmlspecialchars($errors['city']) ?></p>
                <?php } ?>
            </div>
      

            <div class="btnSubmit">
                <button class= "buttonAddLicence"  type="submit" class="btn btn-primary mt-5 mb-5 text-center">Ajouter la licence</button>
            </div>

        </div>
    </form>

</main>
    <?php
    // Inclusion du pied de page
    require_once(__DIR__ . '/../partials/footer.php');
    ?>

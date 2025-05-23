<?php require_once __DIR__ . '/../partials/head.php'; ?>

<main class="editLicenceSimple">
  <h2>Modifier ma licence</h2>

  <?php if (!empty($errorMessage)): ?>
    <p class="error" style="color: red;">
      <?= htmlspecialchars($errorMessage) ?>
    </p>
  <?php endif; ?>

  <form action="/updateLicence" method="POST">
    <!-- ID caché pour savoir quelle licence mettre à jour -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($licence->getId()) ?>">

    <label for="description">Description :</label>
    <input
      type="text"
      id="description"
      name="description"
      value="<?= htmlspecialchars($licence->getDescription()) ?>"
      required
    >

    <label for="availability">Disponibilité :</label>
    <select id="availability" name="availability">
      <option value="1" <?= $licence->getAvailability() ? 'selected' : '' ?>>Disponible</option>
      <option value="0" <?= !$licence->getAvailability() ? 'selected' : '' ?>>Indisponible</option>
    </select>

    <label for="price">Prix (€) :</label>
    <input
      type="number"
      step="0.01"
      id="price"
      name="price"
      value="<?= htmlspecialchars($licence->getPrice()) ?>"
      required
    >

  
      <label for="type">Disponibilité :</label>
    <select id="type" name="type">
      <option value="Location" <?= $licence->getType() ? 'selected' : '' ?>>Location</option>
      <option value="Achat" <?= !$licence->getType() ? 'selected' : '' ?>>Achat</option>
    </select>


    <label for="commissioning_date">Date de mise en service :</label>
    <input
      type="date"
      id="commissioning_date"
      name="commissioning_date"
      value="<?= htmlspecialchars($licence->getCommissioning_Date()) ?>"
      required
    >

    <label for="city">Ville :</label>
    <input
      type="text"
      id="city"
      name="city"
      value="<?= htmlspecialchars($licence->getCity()) ?>"
      required
    >

    <button type="submit">Enregistrer</button>
  </form>
</main>

<?php require_once(__DIR__ . '/../partials/footer.php'); 

<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Mes Licences</h1>

        <?php if (empty($licences)) : ?>
            <div class="alert alert-warning text-center">Aucune licence ajoutée.</div>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Description</th>
                            <th>Prix (€)</th>
                            <th>Type</th>
                            <th>Ville</th>
                            <th>Date d'émission</th>
                            <th>Disponibilité</th>
                            <th>Éditer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($licences as $licence) : ?>
                            <tr>
                                <td><?= htmlspecialchars($licence->getDescription()) ?></td>
                                <td><?= htmlspecialchars($licence->getPrice()) ?> €</td>
                                <td><?= htmlspecialchars($licence->getType()) ?></td>
                                <td><?= htmlspecialchars($licence->getCity()) ?></td>
                                <td><?= htmlspecialchars($licence->getCommissioning_Date()) ?></td>
                                <td>
                                    <span class="badge <?= $licence->getAvailability() ? 'bg-success' : 'bg-danger' ?>">
                                        <?= $licence->getAvailability() ? 'Disponible' : 'Indisponible' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/editLicence?id=<?= $licence->getId() ?>" class="btn btn-warning btn-sm">✏️ Modifier</a>
                                    <form action="/deleteLicence" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette licence ?');" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $licence->getId() ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>

<?php require_once(__DIR__ . '/../partials/footer.php'); ?>

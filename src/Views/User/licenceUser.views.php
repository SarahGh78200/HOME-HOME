<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Licences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

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
                            <th>Type </th>
                            <th>Disponibilité</th>
                            <th>Editer</th>
        
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($licences as $licence) : ?>
        <tr>
            <td><?= htmlspecialchars($licence->getDescription()) ?></td>
            <td><?= htmlspecialchars($licence->getPrice()) ?> €</td>
            <td><?= htmlspecialchars($licence->getType()) ?></td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
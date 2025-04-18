<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<h1>Tableau de bord Admin</h1>


<h2>Utilisateurs</h2>
<table border="2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->getId(); ?></td>
                <td><strong><?= htmlspecialchars($user->getSurname()); ?></strong</td>
                <td> <strong><?= htmlspecialchars($user->getName()); ?></strong></td>
                <td><strong><?= htmlspecialchars($user->getEmail()); ?></strong></td>
                <td><strong><?= $user->getId_Role(); ?></strong></td>
                <td>
                    <a href="/admin/deleteUser?id=<?= $user->getId(); ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<hr>

<h2>Licences</h2>
<table border="2">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Utilisateur ID</th>
            <th>Prix</th>
            <th>Disponibilité</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($licences as $licence): ?>
            <tr>
                <td><?= $licence->getId(); ?></td>
                <td><?= htmlspecialchars($licence->getTitle()); ?></td>
                <td><?= $licence->getIdUser(); ?></td>
                <td><?= $licence->getPrice(); ?> €</td>
                <td><?= $licence->getAvailability() ? 'Oui' : 'Non'; ?></td>
                <td>
                    <a class="aDashBoard" href="/admin/deleteLicence?id=<?= $licence->getId(); ?>" onclick="return confirm('Supprimer cette licence ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php require_once(__DIR__ . '/../partials/footer.php'); ?>
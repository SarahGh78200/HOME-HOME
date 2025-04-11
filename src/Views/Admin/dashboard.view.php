<?php
// Inclusion des fichiers partiels
require_once(__DIR__ . '/../partials/head.php');
?>

<h1>Tableau de bord Admin</h1>

<h2>Utilisateurs</h2>
<table border="1">
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
                <td><?= htmlspecialchars($user->getSurname()); ?></td>
                <td><?= htmlspecialchars($user->getName()); ?></td>
                <td><?= htmlspecialchars($user->getEmail()); ?></td>
                <td><?= $user->getId_Role(); ?></td>
                <td>
                    <a href="/admin/dashboard?editUser=<?= $user->getId(); ?>">Modifier</a>
                    <a href="/admin/deleteUser?id=<?= $user->getId(); ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($editUser): ?>
    <h3>Modifier l'utilisateur</h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $editUser->getId(); ?>">
        <input type="hidden" name="update_user" value="1">

        <label>Nom:</label>
        <input type="text" name="surname" value="<?= htmlspecialchars($editUser->getSurname()); ?>"><br>

        <label>Prénom:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($editUser->getName()); ?>"><br>

        <label>Date de naissance:</label>
        <input type="date" name="birth_date" value="<?= $editUser->getBirthDate(); ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($editUser->getEmail()); ?>"><br>

        <label>Mot de passe:</label>
        <input type="text" name="password" value="<?= htmlspecialchars($editUser->getPassword()); ?>"><br>

        <label>Rôle:</label>
        <input type="number" name="id_role" value="<?= $editUser->getId_Role(); ?>"><br>

        <button type="submit">Enregistrer</button>
    </form>
<?php endif; ?>

<hr>

<h2>Licences</h2>
<table border="1">
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
                    <a href="/admin/dashboard?editLicence=<?= $licence->getId(); ?>">Modifier</a>
                    <a href="/admin/deleteLicence?id=<?= $licence->getId(); ?>" onclick="return confirm('Supprimer cette licence ?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($editLicence): ?>
    <h3>Modifier la licence</h3>
    <form method="post">
        <input type="hidden" name="id" value="<?= $editLicence->getId(); ?>">
        <input type="hidden" name="update_licence" value="1">

        <label>Titre:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($editLicence->getTitle()); ?>"><br>

        <label>Description:</label>
        <textarea name="description"><?= htmlspecialchars($editLicence->getDescription()); ?></textarea><br>

        <label>Disponibilité (0 ou 1):</label>
        <input type="number" name="availability" value="<?= $editLicence->getAvailability(); ?>"><br>

        <label>Image:</label>
        <input type="text" name="picture" value="<?= htmlspecialchars($editLicence->getPicture()); ?>"><br>

        <label>Prix:</label>
        <input type="number" step="0.01" name="price" value="<?= $editLicence->getPrice(); ?>"><br>

        <button type="submit">Mettre à jour</button>
    </form>
<?php endif; ?>

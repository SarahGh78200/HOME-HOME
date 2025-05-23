<?php require_once(__DIR__ . '/../partials/head.php'); ?>

<div class="container my-5">
    <h1 class="text-center mb-4">Tableau de bord Administrateur</h1>

    <hr>

    <!-- Section utilisateurs -->
    <h2 class="mt-4">Utilisateurs</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
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
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user->getId(); ?></td>
                            <td><?= htmlspecialchars($user->getSurname() ?? '') ?></td>
                            <td><?= htmlspecialchars($user->getName() ?? '') ?></td>
                            <td><?= htmlspecialchars($user->getEmail() ?? '') ?></td>
                            <td><?= $user->getId_Role() == 1 ? 'Admin' : 'Utilisateur'; ?></td>
                            <td>
                                <form action="/deleteUser" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cet utilisateur ?');">
                                    <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6" class="text-center">Aucun utilisateur trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Section licences -->
    <h2 class="mt-5">Licences</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Ville</th>
                    <th>Type</th>
                    <th>Disponibilité</th>
                    <th>ID Utilisateur</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($licences)) : ?>
                    <?php foreach ($licences as $licence): ?>
                        <tr>
                            <td><?= $licence->getId(); ?></td>
                            <td><?= htmlspecialchars($licence->getDescription() ?? '') ?></td>
                            <td><?= $licence->getPrice(); ?> €</td>
                            <td><?= htmlspecialchars($licence->getCity() ?? '') ?></td>
                            <td><?= htmlspecialchars($licence->getType() ?? '') ?></td>
                            <td><?= $licence->getAvailability() ? 'Oui' : 'Non'; ?></td>
                            <td><?= $licence->getIdUser(); ?></td>
                            <td>
                                <form action="/deleteLicence" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette licence ?');">
                                    <input type="hidden" name="id" value="<?= $licence->getId(); ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="8" class="text-center">Aucune licence trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once(__DIR__ . '/../partials/footer.php'); ?>

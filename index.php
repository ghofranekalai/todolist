<?php
require_once('./config/connexion.php');
$result = $conn->query("SELECT * FROM todos");
$tasks = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<?php
include('./layout/header.php')
?>
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Liste des tâches</h2>
        <a href="add.php" class="btn btn-success">➕ Ajouter une tâche</a>
    </div>

    <?php if (count($tasks) > 0): ?>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                 <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Date limite</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $index=>$tache): ?>
                     <tr>
                        <td><?= $index+1 ?></td>
                        <td><?= htmlspecialchars($tache['title']) ?></td>
                        <td><?= htmlspecialchars($tache['description']) ?></td>
                        <td><?= $tache['due_date'] ?></td>
                        <td>
                            <?php if ($tache['complete']): ?>
                                <span class="badge bg-success">Terminée</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">En cours</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $tache['id'] ?>" class="btn btn-primary btn-sm">✏️</a>

                            <a href="delete.php?id=<?= $tache['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cette tâche ?')">🗑</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <div class="alert alert-info text-center">
            📭 Aucune tâche disponible pour le moment.
        </div>

    <?php endif; ?>

</div>







<?php
include('./layout/footer.php')
?>
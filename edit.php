<?php
require 'config/connexion.php';

// ✅ 1. Récupérer l'id
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID manquant");
}

// ✅ 2. Récupérer la tâche
$stmt = $conn->prepare("SELECT * FROM todos WHERE id = ?");
$stmt->execute([$id]);
$tache = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tache) {
    die("Tâche introuvable");
}

// ✅ 3. Mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $complete = isset($_POST['complete']) ? 1 : 0;

    $sql = "UPDATE todos 
            SET title = :title, description = :description, due_date = :due_date, complete = :complete
            WHERE id = :id";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute(compact('title','description','due_date','complete','id'))) {
        header("Location: index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Erreur lors de la modification.</div>';
    }
}
?>

<?php include('./layout/header.php'); ?>

<div class="container mt-4">
    <h2>Modifier la tâche</h2>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control"
                   value="<?= htmlspecialchars($tache['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($tache['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Date limite</label>
            <input type="date" name="due_date" class="form-control"
                   value="<?= $tache['due_date'] ?>">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="complete" class="form-check-input"
                   <?= $tache['complete'] ? 'checked' : '' ?>>
            <label class="form-check-label">Tâche terminée</label>
        </div>

        <button type="submit" class="btn btn-primary">
            💾 Modifier
        </button>

        <a href="index.php" class="btn btn-secondary">
            ↩ Retour
        </a>

    </form>
</div>

<?php include('./layout/footer.php'); ?>
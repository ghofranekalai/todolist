<?php
require 'config/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $complete = 0; 

    $sql = "INSERT INTO todos (title, description, due_date, complete) 
            VALUES (:title, :description, :due_date, :complete)";

    $stmt = $conn->prepare($sql);

    if ($stmt->execute(compact('title','description','due_date','complete'))) {
        header("Location: index.php");
        exit();
    } else {
        var_dump($_POST);
        echo '<div class="alert alert-danger">Erreur lors de l\'insertion.</div>';
    }
}
?>
<?php
include('./layout/header.php')
?>
<div class="container">
    <h2 class="mb-4">Ajouter une nouvelle tâche</h2>
    <div class="container mt-4">
    <h2>Ajouter une tâche</h2>

    <form method="POST" action="add.php">

        <div class="mb-3">
            <label class="form-label">Titre</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Date limite</label>
            <input type="date" name="due_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">
            💾 Enregistrer
        </button>

        <a href="index.php" class="btn btn-secondary">
            ↩ Retour
        </a>

    </form>
</div>



<?php
include('./layout/footer.php')
?>
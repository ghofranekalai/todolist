<?php
require 'config/connexion.php';

// Vérifier si id existe
$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID manquant");
}

// Supprimer la tâche
$stmt = $conn->prepare("DELETE FROM todos WHERE id = ?");
$stmt->execute([$id]);

// Redirection
header("Location: index.php");
exit();
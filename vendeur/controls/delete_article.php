<?php
// Inclure le fichier de connexion à la base de données
include '../db_connection.php'; // Assurez-vous que le chemin est correct

// Vérifier si l'ID de l'article est passé en paramètre
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $articleId = intval($_POST['id']);

    // Préparer la requête pour supprimer l'article
    $query = "DELETE FROM article WHERE id_article = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $articleId);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Article supprimé avec succès.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression de l\'article.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID d\'article invalide.']);
}

// Fermer la connexion
$connection->close();
?>
<?php
// Inclure le fichier de connexion à la base de données
include '../../db_connection.php'; // Assurez-vous que le chemin est correct

// Vérifier si l'ID de l'article est passé en paramètre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $articleId = intval($_GET['id']);

    // Préparer la requête pour récupérer l'article
    $query = "SELECT * FROM article WHERE id_article = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifier si l'article existe
    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
        // Renvoyer les données de l'article au format JSON
        echo json_encode(['success' => true, 'article' => $article]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Article non trouvé.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID d\'article invalide.']);
}

// Fermer la connexion
?>

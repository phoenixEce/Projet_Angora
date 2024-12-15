<?php
// Inclure le fichier de connexion à la base de données
include '../../db_connection.php';

// Lire les données JSON envoyées par la requête fetch
$data = json_decode(file_get_contents('php://input'), true);

echo $data['nom'];
echo $data['categorie'];
echo $data['type_vente'];
echo $data['description'];
echo $data['prix'];
echo $data['statut'];
echo $data['photo_url'];

// Vérifier que les données nécessaires sont présentes
if (isset($data['nom'], $data['categorie'], $data['type_vente'], $data['description'], $data['prix'], $data['statut'], $data['photo_url'])) {
    // Assigner les données aux variables PHP
    $nom = $connection->real_escape_string($data['nom']);
    $categorie = $connection->real_escape_string($data['categorie']);
    $type_vente = $connection->real_escape_string($data['type_vente']);
    $description = $connection->real_escape_string($data['description']);
    $prix = floatval($data['prix']);
    $statut = $connection->real_escape_string($data['statut']);
    $photo_url = $connection->real_escape_string($data['photo_url']);
    $id_article = intval($_GET['id']);

    // Préparer la requête de mise à jour
    $query = "UPDATE article SET 
        nom='$nom', 
        categorie='$categorie', 
        type_vente='$type_vente', 
        description='$description', 
        prix=$prix, 
        statut='$statut', 
        photo_url='$photo_url' 
        WHERE id_article=$id_article"; // Assurez-vous que l'id est passé ou présent dans l'URL

    echo $query;
    // Exécuter la requête
    if ($connection->query($query) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la mise à jour du produit: ' . $connection->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Données manquantes.']);
}

// Fermer la connexion
$connection->close();
?>

<?php
// Inclure le fichier de connexion à la base de données
include '../../db_connection.php';

// Lire les données JSON envoyées par la requête fetch
$data = json_decode(file_get_contents('php://input'), true);


// Vérifier que les données nécessaires sont présentes
if (isset($_POST['id_article']) && isset($_POST['productName'])) {
    $id_article = $_POST['id'];
    $nom = $_POST['productName'];
    $categorie = $_POST['productCategory'];
    $description = $_POST['productDescription'];
    $prix = $_POST['productPrice'];
    $statut = $_POST['productStatus'];
    $type_vente = $_POST['productSaleType'];

    $photo_url = $_POST['productImage'];

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

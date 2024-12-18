<?php
// Inclure le fichier de connexion
include '../../db_connection.php';

session_start();
$id_user = $_SESSION['id_utilisateur'];


// Vérifier si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = $connection->real_escape_string($_POST['productName']);
    $description = $connection->real_escape_string($_POST['productDescription']);
    $categorie = $connection->real_escape_string($_POST['productCategory']);
    $prix = floatval($_POST['productPrice']); // Assurez-vous que c'est un nombre
    $type_vente = $connection->real_escape_string($_POST['productSaleType']);
    $statut = $connection->real_escape_string($_POST['productStatus']);
    $id_vendeur = $id_user; // Assurez-vous que c'est un entier

    $start_date = $_POST['productStartDate'] ? $_POST['productStartDate'] : "";

    $end_date = $_POST['productEndDate'] ? $_POST['productEndDate'] : "";


    // Gérer le téléchargement de l'image
    $photo_url = '';
    if (isset($_FILES['photo_url']) && $_FILES['photo_url']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../../uploads/"; // Dossier où les images seront stockées
        $target_file = $target_dir . basename($_FILES["photo_url"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image
        $check = getimagesize($_FILES["photo_url"]["tmp_name"]);
        if ($check !== false) {
            // Déplacer le fichier téléchargé vers le dossier cible
            if (move_uploaded_file($_FILES["photo_url"]["tmp_name"], $target_file)) {
                $photo_url = $target_file; // Enregistrer le chemin de l'image
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors du téléchargement de l\'image.']);
                exit;
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Le fichier téléchargé n\'est pas une image.']);
            exit;
        }
    }

    if ($start_date == "" && $end_date == "") {
        // Préparer la requête d'insertion
        $query = "INSERT INTO article (nom, description, categorie, prix, type_vente, statut, photo_url, id_vendeur) 
    VALUES ('$nom', '$description', '$categorie', $prix, '$type_vente', '$statut', '$photo_url', $id_vendeur)";
    } else {
        # code...
        $query = "INSERT INTO article (nom, description, categorie, prix, type_vente, statut, photo_url, id_vendeur) 
    VALUES ('$nom', '$description', '$categorie', $prix, '$type_vente', '$statut', '$photo_url', $id_vendeur)";

        $queryEnchere = "INSERT INTO enchere (`id_article`, `date_debut`, `date_fin`, `prix_initial`, `prix_final`, `gagnant`) 
    VALUES ('$nom', '$description', '$categorie', $prix, '$type_vente', '$statut', '$photo_url', $id_vendeur)";
    }


    // Exécuter la requête
    if ($connection->query($query) === TRUE) {

        $sql = "SELECT id_article FROM article WHERE nom = '" . $nom . "'";
        $result = $connection->query($sql);
        $id_article = $result->fetch_assoc()['id_article'];

        if ($start_date != "" && $end_date != "") {
            $queryEnchere = "INSERT INTO enchere (`id_article`, `date_debut`, `date_fin`, `prix_initial`, `prix_final`, `gagnant`) 
        VALUES ($id_article, '$start_date', '$end_date', $prix, 0, NULL)";

            if ($connection->query($queryEnchere) === TRUE) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de l\'enchère : ' . $connection->error]);
            }
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du produit : ' . $connection->error]);
    }

    // Fermer la connexion
    $connection->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Requête invalide.']);
}

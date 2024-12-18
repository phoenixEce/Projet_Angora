<?php
include "db_connection.php";

// Vérifie si une catégorie est envoyée via POST
if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Requête SQL pour récupérer les produits en fonction de la catégorie
    $stmt = $connection->prepare("SELECT * FROM article WHERE categorie = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifie s'il y a des résultats
    if ($result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <!-- Récupère l'image de l'article -->
                        <img src="<?= htmlspecialchars($product['photo_url']); ?>" 
                             alt="<?= htmlspecialchars($product['nom']); ?>" 
                             class="img-fluid">
                        <div class="product-actions">
                            <button class="action-btn favorite">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="action-btn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><?= htmlspecialchars($product['nom']); ?></h2>
                        <div class="product-rating">
                            <div class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <span class="rating-value">3.5/5</span>
                        </div>
                        <div class="product-type"><?= htmlspecialchars($product['type_vente']); ?></div>
                        <div class="product-price"><?= number_format($product['prix'], 2); ?>€</div>
                        <a href="product_details.php?id=<?= htmlspecialchars($product['id_article']); ?>" 
                           class="btn btn-primary btn-sm">
                            Voir Détails
                        </a>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "<div class='col-12 alert alert-warning'>Aucun produit trouvé pour cette catégorie.</div>";
    }
    $stmt->close();
} else {
    echo "<div class='col-12 alert alert-danger'>Catégorie non spécifiée.</div>";
}

$connection->close();
?>

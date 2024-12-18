<?php
include "db_connection.php";

// Vérifie si une catégorie est envoyée via POST
if (isset($_POST['category'])) {
    $category = $_POST['category'];

    // Requête SQL pour récupérer les produits en fonction de la catégorie
    $stmt = $connection->prepare("SELECT * FROM article WHERE type_vente = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifie s'il y a des résultats
    if ($result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) { ?>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Produit" class="product-image">
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
                        <h2 class="product-title"><?php echo htmlspecialchars($product['nom']); ?></h2>
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
                        <div class="product-type"><?php echo htmlspecialchars($product['type_vente']); ?></div>
                        <div class="product-price"><?php echo htmlspecialchars($product['prix']); ?>€</div>
                        <button class="add-to-cart"><a href="product_detail.php?id=<?php echo htmlspecialchars($product['id_article']); ?>"><i class="bi bi-cart cart-icon"></i>
                            Ajouter au panier</a>
                        </button>
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

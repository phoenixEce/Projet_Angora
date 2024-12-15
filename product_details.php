<?php
ob_start(); // Active la mise en tampon de sortie
session_start();
include "header.php";

// Configuration de la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification si un ID de produit est fourni
    if (isset($_GET['id'])) {
        $productId = intval($_GET['id']);

        // Récupérer les informations du produit
        $stmt = $pdo->prepare("SELECT * FROM Article WHERE id_article = :id_article AND statut = 'Disponible'");
        $stmt->execute([':id_article' => $productId]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            die("<div class='container mt-5'><h1>Produit introuvable ou non disponible.</h1></div>");
        }
    } else {
        die("<div class='container mt-5'><h1>Aucun produit sélectionné.</h1></div>");
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Ajouter au panier dans la base de données
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    // Vérifier que l'utilisateur est connecté
    if (!isset($_SESSION['id_utilisateur'])) {
        die("<div class='container mt-5'><h1>Vous devez être connecté pour ajouter un produit au panier.</h1></div>");
    }

    $idAcheteur = $_SESSION['id_utilisateur'];
    $quantity = max(1, intval($_POST['quantity']));
    $dateCreation = date('Y-m-d H:i:s');

    try {
        // Vérifier si le produit est déjà dans le panier
        $checkStmt = $pdo->prepare("SELECT * FROM Panier WHERE id_acheteur = :id_acheteur AND id_article = :id_article");
        $checkStmt->execute([
            ':id_acheteur' => $idAcheteur,
            ':id_article' => $productId,
        ]);
        $existingItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

        if ($existingItem) {
            // Écraser la quantité existante par la nouvelle
            $updateStmt = $pdo->prepare("UPDATE Panier SET quantite = :quantite WHERE id_panier = :id_panier");
            $updateStmt->execute([
                ':quantite' => $quantity,
                ':id_panier' => $existingItem['id_panier'],
            ]);
        } else {
            // Insérer un nouvel article dans le panier
            $insertStmt = $pdo->prepare("INSERT INTO Panier (id_acheteur, id_article, quantite, date_creation) VALUES (:id_acheteur, :id_article, :quantite, :date_creation)");
            $insertStmt->execute([
                ':id_acheteur' => $idAcheteur,
                ':id_article' => $productId,
                ':quantite' => $quantity,
                ':date_creation' => $dateCreation,
            ]);
        }

        // Redirection après ajout au panier
        header("Location: product_details.php?id=$productId&success=1");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'ajout au panier : " . $e->getMessage());
    }
}
?>




<style>
    .product-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .product-image {
        width: 100%;
        border-radius: 8px;
        background: #000;
    }

    .product-title {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .rating-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .stars {
        color: #ffc107;
    }

    .review-count {
        color: #666;
    }

    .stock-status {
        color: #0dcaf0;
    }

    .product-price {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .product-description {
        color: #333;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .quantity-input {
        width: 80px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 8px;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #f8f9fa;
    }

    .buy-button {
        width: 200px;
        padding: 12px;
        background: #0dcaf0;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .buy-button:hover {
        background: #0bb5d9;
    }

    .info-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .info-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .info-title {
        font-weight: 600;
        margin: 0;
    }

    .info-link {
        color: #0dcaf0;
        text-decoration: none;
    }

    .info-link:hover {
        text-decoration: underline;
    }
</style>

<body>
<div class="product-container">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
            <img src="<?= htmlspecialchars($product['photo_url']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>" class="product-image">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1 class="product-title"><?= htmlspecialchars($product['nom']) ?></h1>

            <div class="rating-container">
                <div class="stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                </div>
                <span class="review-count">(150 Reviews)</span>
                <span class="stock-status">En Stock</span>
            </div>

            <div class="product-price"><?= number_format($product['prix'], 2) ?>€</div>

            <p class="product-description">
                <?= htmlspecialchars($product['description']) ?>
            </p>

            <!-- Formulaire d'ajout au panier -->
            <form method="POST">
                <div class="quantity-selector">
                    <button type="button" class="quantity-btn decrement-btn">-</button>
                    <input type="number" name="quantity" id="quantity" class="quantity-input" value="1" min="1">
                    <button type="button" class="quantity-btn increment-btn">+</button>
                </div>
                    <button type="submit" class="buy-button" name="add_to_cart">Ajouter au panier</button>
            </form>


            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success mt-3">Produit ajouté au panier avec succès !</div>
            <?php endif; ?>


            <!-- Delivery Info -->
            <div class="info-card">
                <div class="info-header">
                    <i class="bi bi-truck" style="font-size: 1.5rem;"></i>
                    <h3 class="info-title">Livraison Gratuite</h3>
                </div>
                <a href="#" class="info-link">Entrez votre code postal pour la disponibilité</a>
            </div>

            <!-- Returns Info -->
            <div class="info-card">
                <div class="info-header">
                    <i class="bi bi-arrow-counterclockwise" style="font-size: 1.5rem;"></i>
                    <h3 class="info-title">Retour sous 30 jours</h3>
                </div>
                <p class="mb-0">Retour sous 30 jours. <a href="#" class="info-link">Voir les détails</a></p>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const decrementBtn = document.querySelector(".decrement-btn");
        const incrementBtn = document.querySelector(".increment-btn");
        const quantityInput = document.getElementById("quantity");

        // Décrémentation
        decrementBtn.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Incrémentation
        incrementBtn.addEventListener("click", function () {
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
        });
    });
</script>


</body>
</html>

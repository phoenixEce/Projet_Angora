<?php
session_start();
include 'header.php';

// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les articles disponibles
    $stmt = $pdo->prepare("SELECT * FROM Article WHERE statut = 'Disponible'");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Initialiser le panier s'il n'existe pas encore
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Ajouter un article au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $articleId = $_POST['article_id'];
    $quantity = $_POST['quantity'] ?? 1;

    if (isset($_SESSION['panier'][$articleId])) {
        $_SESSION['panier'][$articleId] += $quantity;
    } else {
        $_SESSION['panier'][$articleId] = $quantity;
    }

    header('Location: products.php');
    exit();
}
?>

<div class="container py-5">
    <h1 class="text-center mb-4">Nos Articles Disponibles</h1>
    <div class="row g-4">
        <?php foreach ($articles as $article): ?>
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="<?= htmlspecialchars($article['photo_url']) ?>" alt="<?= htmlspecialchars($article['nom']) ?>" class="product-image">
                        <div class="product-actions">
                            <button class="action-btn favorite" data-article-id="<?= $article['id_article'] ?>">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title"><?= htmlspecialchars($article['nom']) ?></h2>
                        <div class="product-category"><?= htmlspecialchars($article['categorie']) ?></div>
                        <div class="product-price"><?= number_format($article['prix'], 2) ?>€</div>
                        <form method="POST" class="mt-3">
                            <input type="hidden" name="article_id" value="<?= $article['id_article'] ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" name="add_to_cart" class="add-to-cart">
                                <i class="bi bi-cart cart-icon"></i>
                                Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    // Gestion des favoris avec AJAX
    document.querySelectorAll('.favorite').forEach(button => {
        button.addEventListener('click', function() {
            const articleId = this.dataset.articleId;
            const action = this.classList.contains('active') ? 'remove' : 'add';

            fetch('favorite_action.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ articleId, action })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('active');
                    const icon = this.querySelector('i');
                    if (this.classList.contains('active')) {
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                    } else {
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                    }
                } else {
                    alert('Erreur : ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur AJAX :', error);
            });
        });
    });
</script>

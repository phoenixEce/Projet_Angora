<?php
include 'header.php';
include 'db_connection.php'; // Assurez-vous que ce fichier gère correctement la connexion à la base de données

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les articles disponibles
    $stmt = $pdo->prepare("SELECT id_article, nom, prix, photo_url FROM Article WHERE statut = 'Disponible' LIMIT 4");
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<main class="container mt-5">
    <!-- Section Promotions -->
    <section class="promotions">
        <div class="row align-items-center">
            <div class="col-md-7">
                <p class="title display-4 fw-bold">DÉCOUVREZ LES MEILLEURES OFFRES DE LA SEMAINE</p>
                <p class="lead it">Des montres connectées à partir de</p>
                <p class="title display-1 fw-bold">259€</p>
                <a href="products.php" class="btn btn-primary btn-lg rounded-1 px-5">Parcourir</a>
            </div>
            <div class="col-md-5">
                <img src="images/image (1).jpeg" alt="Montre connectée" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- Section Ventes Flash -->
    <section class="countdown mt-5">
        <div class="countdown-container">
            <span class="today-badge fw-bold">Aujourd'hui</span>
            <div class="content-wrapper">
                <h1 class="titleCounting">Ventes Flash</h1>
                <div class="countdown">
                    <div class="countdown-item">
                        <div class="countdown-label">Jours</div>
                        <div class="countdown-value" id="days">03</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-label">Heures</div>
                        <div class="countdown-value" id="hours">23</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-label">Minutes</div>
                        <div class="countdown-value" id="minutes">19</div>
                    </div>
                    <div class="countdown-separator">:</div>
                    <div class="countdown-item">
                        <div class="countdown-label">Secondes</div>
                        <div class="countdown-value" id="seconds">56</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Produits -->
    <section class="products mt-5">
        <h2 class="text-center mb-4">Nos Produits</h2>
        <div class="row g-4">
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="col-md-3">
                        <div class="product-card text-center">
                            <img src="<?= htmlspecialchars($article['photo_url']) ?>" alt="<?= htmlspecialchars($article['nom']) ?>" class="img-fluid">
                            <h5 class="mt-3 fw-bolder"><?= htmlspecialchars($article['nom']) ?></h5>
                            <p class="fw-bold"><?= number_format($article['prix'], 2) ?>€</p>
                            <a href="product_details.php?id=<?= $article['id_article'] ?>" class="btn btn-primary btn-sm">Voir Détails</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Aucun produit disponible pour le moment.</p>
            <?php endif; ?>
        </div>

        <!-- View More Button -->
        <div class="text-center mt-4">
                <a href="products_by_category.php"><button class="btn btn-primary btn-lg rounded-1 px-5 p-2 mt-5">Tout voir</button></a>
        </div>
    </section>

    <!-- Section Catégories -->
    <section class="categories mt-5">
        <h2 class="text-center mb-4">Découvrez Nos Catégories</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="category-card text-center">
                    <i class="bi bi-gem display-3"></i>
                    <h5 class="mt-3">Articles Rares</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card text-center">
                    <i class="bi bi-stars display-3"></i>
                    <h5 class="mt-3">Articles Haut de Gamme</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card text-center">
                    <i class="bi bi-box display-3"></i>
                    <h5 class="mt-3">Articles Réguliers</h5>
                </div>
            </div>
            <div class="col-md-3">
                <div class="category-card text-center">
                    <i class="bi bi-list display-3"></i>
                    <h5 class="mt-3">Autres</h5>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include 'footer.php';
?>

<script>
    const countdown = () => {
        const deadline = new Date("2024-12-31T23:59:59").getTime();
        const now = new Date().getTime();
        const difference = deadline - now;

        if (difference > 0) {
            document.getElementById("days").innerText = Math.floor(difference / (1000 * 60 * 60 * 24));
            document.getElementById("hours").innerText = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            document.getElementById("minutes").innerText = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
            document.getElementById("seconds").innerText = Math.floor((difference % (1000 * 60)) / 1000);
        }
    };
    setInterval(countdown, 1000);
</script>

<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: signin.php?error=NonConnecte");
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

include "header.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $idAcheteur = $_SESSION['id_utilisateur'];

    // Récupérer les articles du panier
    $stmt = $pdo->prepare("
        SELECT 
            Panier.quantite, 
            Article.nom, 
            Article.description, 
            Article.prix, 
            Article.photo_url
        FROM Panier
        INNER JOIN Article ON Panier.id_article = Article.id_article
        WHERE Panier.id_acheteur = :id_acheteur
    ");
    $stmt->execute([':id_acheteur' => $idAcheteur]);
    $panierArticles = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>


<div class="container mt-5">
    <h1 class="mb-4">Mon Panier</h1>
    <?php if (!empty($panierArticles)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Produit</th>
                    <th>Description</th>
                    <th>Prix Unitaire</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($panierArticles as $article): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($article['photo_url']) ?>" alt="<?= htmlspecialchars($article['nom']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($article['nom']) ?></td>
                        <td><?= htmlspecialchars($article['description']) ?></td>
                        <td><?= number_format($article['prix'], 2) ?> €</td>
                        <td><?= htmlspecialchars($article['quantite']) ?></td>
                        <td><?= number_format($article['prix'] * $article['quantite'], 2) ?> €</td>
                        <?php $total += $article['prix'] * $article['quantite']; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-end">
            <h4>Total : <?= number_format($total, 2) ?> €</h4>
            <a href="checkout.php" class="btn btn-success">Valider la commande</a>
        </div>
    <?php else: ?>
        <p>Votre panier est vide.</p>
        <a href="products.php" class="btn btn-primary">Retour aux produits</a>
    <?php endif; ?>
</div>

<?php
include "footer.php"
?>
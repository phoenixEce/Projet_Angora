<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

include "header.php";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id_utilisateur']; // ID de l'utilisateur connecté

// Vérifier si l'ID de la négociation est passé via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de négociation invalide.";
    exit();
}

$negociation_id = $_GET['id'];

// Récupérer les détails de la négociation
$stmt = $pdo->prepare("SELECT n.*, a.nom AS article_nom, a.prix, a.photo_url, a.description, u.nom AS vendeur_nom, u.prenom AS vendeur_prenom 
                       FROM Negotiation n
                       JOIN Article a ON n.id_article = a.id_article
                       JOIN Utilisateur u ON n.id_vendeur = u.id_utilisateur
                       WHERE n.id_negotiation = :negociation_id AND (n.id_acheteur = :user_id OR n.id_vendeur = :user_id)");
$stmt->execute(['negociation_id' => $negociation_id, 'user_id' => $user_id]);

$negociation = $stmt->fetch(PDO::FETCH_ASSOC);

// Si la négociation n'est pas trouvée
if (!$negociation) {
    echo "Négociation introuvable ou vous n'avez pas accès à ces détails.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Négociation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Ma Boutique</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="mes_commandes.php">Mes Commandes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="deconnexion.php">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Détails de la négociation -->
    <div class="container mt-5">
        <h2>Détails de la Négociation #<?= $negociation['id_negotiation'] ?></h2>

        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($negociation['photo_url']) ?>" class="img-fluid" alt="Image de l'article">
            </div>
            <div class="col-md-6">
                <h4><?= htmlspecialchars($negociation['article_nom']) ?></h4>
                <p><strong>Description :</strong> <?= htmlspecialchars($negociation['description']) ?></p>
                <p><strong>Prix initial :</strong> <?= number_format($negociation['prix'], 2, ',', ' ') ?> €</p>
                <p><strong>Offre de l'acheteur :</strong> <?= number_format($negociation['offre_acheteur'], 2, ',', ' ') ?> €</p>
                <p><strong>Contre-offre du vendeur :</strong> 
                    <?php if ($negociation['contre_offre_vendeur']) {
                        echo number_format($negociation['contre_offre_vendeur'], 2, ',', ' ') . " €";
                    } else {
                        echo "Pas encore faite";
                    } ?>
                </p>
                <p><strong>Statut :</strong> 
                    <span class="badge bg-<?= $negociation['statut_negotiation'] == 'Conclue' ? 'success' : ($negociation['statut_negotiation'] == 'Echouee' ? 'danger' : 'warning') ?>">
                        <?= htmlspecialchars($negociation['statut_negotiation']) ?>
                    </span>
                </p>
                <p><strong>Vendeur :</strong> <?= htmlspecialchars($negociation['vendeur_nom']) ?> <?= htmlspecialchars($negociation['vendeur_prenom']) ?></p>
            </div>
        </div>

        <a href="mes_commandes.php" class="btn btn-secondary mt-3">Retour aux Négociations</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

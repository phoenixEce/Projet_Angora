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

// Vérifier si l'ID de l'enchère est passé via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID d'enchère invalide.";
    exit();
}

$enchere_id = $_GET['id'];

// Récupérer les détails de l'enchère
$stmt = $pdo->prepare("SELECT e.*, a.nom AS article_nom, a.prix_initial, a.photo_url 
                       FROM Enchere e
                       JOIN Article a ON e.id_article = a.id_article
                       WHERE e.id_enchere = :enchere_id");
$stmt->execute(['enchere_id' => $enchere_id]);

$enchere = $stmt->fetch(PDO::FETCH_ASSOC);

// Si l'enchère n'est pas trouvée
if (!$enchere) {
    echo "Enchère introuvable.";
    exit();
}
?>


    <!-- Détails de l'enchère -->
    <div class="container mt-5">
        <h2>Détails de l'Enchère #<?= $enchere['id_enchere'] ?></h2>

        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($enchere['photo_url']) ?>" class="img-fluid" alt="Image de l'article">
            </div>
            <div class="col-md-6">
                <h4><?= htmlspecialchars($enchere['article_nom']) ?></h4>
                <p><strong>Prix initial :</strong> <?= number_format($enchere['prix_initial'], 2, ',', ' ') ?> €</p>
                <p><strong>Date de début :</strong> <?= htmlspecialchars($enchere['date_debut']) ?></p>
                <p><strong>Date de fin :</strong> <?= htmlspecialchars($enchere['date_fin']) ?></p>
                <p><strong>Prix final :</strong> <?= $enchere['prix_final'] ? number_format($enchere['prix_final'], 2, ',', ' ') : 'En cours' ?></p>
                <p><strong>Statut :</strong> <?= $enchere['gagnant'] ? 'Gagnée par vous' : 'En cours' ?></p>
            </div>
        </div>

        <a href="mes_commandes.php" class="btn btn-secondary mt-3">Retour aux Enchères</a>
    </div>

<?php
    include "../footer.php";
?>
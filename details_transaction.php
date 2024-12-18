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

// Vérifier si l'ID de la transaction est passé via GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID de transaction invalide.";
    exit();
}

$transaction_id = $_GET['id'];

// Récupérer les détails de la transaction
$stmt = $pdo->prepare("SELECT t.*, a.nom AS article_nom, a.prix, a.photo_url, a.description 
                       FROM Transaction t
                       JOIN Article a ON t.id_article = a.id_article
                       WHERE t.id_transaction = :transaction_id AND t.id_acheteur = :user_id");
$stmt->execute(['transaction_id' => $transaction_id, 'user_id' => $user_id]);

$transaction = $stmt->fetch(PDO::FETCH_ASSOC);

// Si la transaction n'est pas trouvée
if (!$transaction) {
    echo "Transaction introuvable ou vous n'avez pas accès à ces détails.";
    exit();
}
?>

    <!-- Détails de la transaction -->
    <div class="container mt-5">
        <h2>Détails de la Transaction #<?= $transaction['id_transaction'] ?></h2>

        <div class="row">
            <div class="col-md-6">
                <img src="<?= htmlspecialchars($transaction['photo_url']) ?>" class="img-fluid" alt="Image de l'article">
            </div>
            <div class="col-md-6">
                <h4><?= htmlspecialchars($transaction['article_nom']) ?></h4>
                <p><strong>Description :</strong> <?= htmlspecialchars($transaction['description']) ?></p>
                <p><strong>Prix :</strong> <?= number_format($transaction['prix'], 2, ',', ' ') ?> €</p>
                <p><strong>Montant total :</strong> <?= number_format($transaction['montant'], 2, ',', ' ') ?> €</p>
                <p><strong>Mode de paiement :</strong> <?= htmlspecialchars($transaction['mode_paiement']) ?></p>
                <p><strong>Date de transaction :</strong> <?= htmlspecialchars($transaction['date_transaction']) ?></p>
                <p><strong>Statut de la transaction :</strong> 
                    <span class="badge bg-<?= $transaction['statut_transaction'] == 'Reussie' ? 'success' : 'danger' ?>">
                        <?= htmlspecialchars($transaction['statut_transaction']) ?>
                    </span>
                </p>
            </div>
        </div>

        <a href="mes_commandes.php" class="btn btn-secondary mt-3">Retour aux Commandes</a>
    </div>
<?php
    include "../footer.php";
?>

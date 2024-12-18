<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

session_start();

include "header.php";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id_utilisateur']; // L'ID de l'utilisateur connecté

// Récupérer les transactions (commandes effectuées)
$stmt = $pdo->prepare("SELECT t.*, a.nom AS article_nom, a.prix, a.photo_url 
                       FROM Transaction t 
                       JOIN Article a ON t.id_article = a.id_article 
                       WHERE t.id_acheteur = :user_id 
                       ORDER BY t.date_transaction DESC");
$stmt->execute(['user_id' => $user_id]);
$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les enchères auxquelles l'utilisateur a participé
$stmt_enchere = $pdo->prepare("SELECT e.*, a.nom AS article_nom, a.prix, a.photo_url 
                               FROM Enchere e, article a
                               WHERE e.gagnant = :user_id OR e.date_fin >= NOW()");
$stmt_enchere->execute(['user_id' => $user_id]);
$encheres = $stmt_enchere->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les négociations où l'utilisateur est impliqué
$stmt_negotiation = $pdo->prepare("SELECT n.*, a.nom AS article_nom, a.prix, a.photo_url 
                                   FROM Negotiation n 
                                   JOIN Article a ON n.id_article = a.id_article 
                                   WHERE n.id_acheteur = :user_id OR n.id_vendeur = :user_id");
$stmt_negotiation->execute(['user_id' => $user_id]);
$negociations = $stmt_negotiation->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
        .container {
            margin-top: 50px;
        }

        .order-card,
        .auction-card,
        .negotiation-card {
            margin-bottom: 15px;
        }

        .badge-status {
            font-weight: bold;
        }
    </style>


    <!-- Page content -->
    <div class="container">
        <h3>Mes Commandes</h3>

        <!-- Commandes -->
        <h4>Mes Transactions</h4>
        <div class="row">
            <?php if ($transactions): ?>
                <?php foreach ($transactions as $transaction): ?>
                    <div class="col-md-4">
                        <div class="card order-card">
                            <img src="<?= htmlspecialchars($transaction['photo_url']) ?>" class="card-img-top" alt="Image de l'article">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($transaction['article_nom']) ?></h5>
                                <p class="card-text">
                                    Montant : <?= number_format($transaction['montant'], 2, ',', ' ') ?> €<br>
                                    Date de la transaction : <?= htmlspecialchars($transaction['date_transaction']) ?><br>
                                    Statut : <span class="badge bg-<?= $transaction['statut_transaction'] === 'Reussie' ? 'success' : 'danger' ?>"><?= htmlspecialchars($transaction['statut_transaction']) ?></span><br>
                                </p>
                                <a href="details_transaction.php?id=<?= $transaction['id_transaction'] ?>" class="btn btn-primary">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune transaction trouvée.</p>
            <?php endif; ?>
        </div>

        <!-- Enchères -->
        <h4>Mes Enchères</h4>
        <div class="row">
            <?php if ($encheres): ?>
                <?php foreach ($encheres as $enchere): ?>
                    <div class="col-md-4">
                        <div class="card auction-card">
                            <img src="<?= htmlspecialchars($enchere['photo_url']) ?>" class="card-img-top" alt="Image de l'article">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($enchere['article_nom']) ?></h5>
                                <p class="card-text">
                                    Prix initial : <?= number_format($enchere['prix_initial'], 2, ',', ' ') ?> €<br>
                                    Date de fin : <?= htmlspecialchars($enchere['date_fin']) ?><br>
                                    Statut : <span class="badge bg-<?= $enchere['gagnant'] == $user_id ? 'success' : 'warning' ?>"><?= $enchere['gagnant'] == $user_id ? 'Gagné' : 'En cours' ?></span><br>
                                </p>
                                <a href="details_enchere.php?id=<?= $enchere['id_enchere'] ?>" class="btn btn-primary">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune enchère trouvée.</p>
            <?php endif; ?>
        </div>

        <!-- Négociations -->
        <h4>Mes Négociations</h4>
        <div class="row">
            <?php if ($negociations): ?>
                <?php foreach ($negociations as $negociation): ?>
                    <div class="col-md-4">
                        <div class="card negotiation-card">
                            <img src="<?= htmlspecialchars($negociation['photo_url']) ?>" class="card-img-top" alt="Image de l'article">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($negociation['article_nom']) ?></h5>
                                <p class="card-text">
                                    Offre acheteur : <?= number_format($negociation['offre_acheteur'], 2, ',', ' ') ?> €<br>
                                    Contre-offre vendeur : <?= $negociation['contre_offre_vendeur'] ? number_format($negociation['contre_offre_vendeur'], 2, ',', ' ') : 'Aucune' ?><br>
                                    Statut : <span class="badge bg-<?= $negociation['statut_negotiation'] === 'Conclue' ? 'success' : ($negociation['statut_negotiation'] === 'Echouee' ? 'danger' : 'warning') ?>"><?= htmlspecialchars($negociation['statut_negotiation']) ?></span><br>
                                </p>
                                <a href="details_negociation.php?id=<?= $negociation['id_negotiation'] ?>" class="btn btn-primary">Voir Détails</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Aucune négociation trouvée.</p>
            <?php endif; ?>
        </div>

    </div>
    <?php
    include "../footer.php";
    ?>
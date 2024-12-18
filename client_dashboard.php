<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: signin.php');
    exit();
}

// Configuration de la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';



try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_acheteur = $_SESSION['id_utilisateur'];

    // Récupérer les informations du client
    $stmtUser = $pdo->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
    $stmtUser->execute([':id_utilisateur' => $id_acheteur]);
    $client = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if (!$client) {
        die("Utilisateur introuvable.");
    }

    // Récupérer les commandes du client
    $stmtOrders = $pdo->prepare("
        SELECT t.id_transaction, a.nom AS article, t.montant, t.date_transaction, t.mode_paiement, t.statut_transaction
        FROM Transaction t
        JOIN Article a ON t.id_article = a.id_article
        WHERE t.id_acheteur = :id_acheteur
        ORDER BY t.date_transaction DESC
    ");
    $stmtOrders->execute([':id_acheteur' => $id_acheteur]);
    $commandes = $stmtOrders->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php"; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Bienvenue, <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?></h1>

        <!-- Informations du client -->
        <div class="card mb-4">
            <div class="card-header">Vos Informations</div>
            <div class="card-body">
                <p><strong>Nom :</strong> <?= htmlspecialchars($client['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($client['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($client['email']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($client['telephone']) ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($client['adresse']) ?></p>
            </div>
        </div>

        <!-- Liste des commandes -->
        <div class="card">
            <div class="card-header">Vos Commandes</div>
            <div class="card-body">
                <?php if (count($commandes) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Mode de Paiement</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($commandes as $index => $commande): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($commande['article']) ?></td>
                                    <td><?= number_format($commande['montant'], 2) ?> €</td>
                                    <td><?= htmlspecialchars($commande['date_transaction']) ?></td>
                                    <td><?= htmlspecialchars($commande['mode_paiement']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $commande['statut_transaction'] === 'Reussie' ? 'success' : 'danger' ?>">
                                            <?= htmlspecialchars($commande['statut_transaction']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucune commande trouvée.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>

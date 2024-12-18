<?php
session_start();


// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer les listes d'utilisateurs et d'articles
    $stmtClients = $pdo->query("SELECT * FROM Utilisateur WHERE type_utilisateur = 'Client'");
    $clients = $stmtClients->fetchAll(PDO::FETCH_ASSOC);

    $stmtVendeurs = $pdo->query("SELECT * FROM Utilisateur WHERE type_utilisateur = 'Vendeur'");
    $vendeurs = $stmtVendeurs->fetchAll(PDO::FETCH_ASSOC);

    $stmtArticles = $pdo->query("SELECT * FROM Article");
    $articles = $stmtArticles->fetchAll(PDO::FETCH_ASSOC);

    // Supprimer un utilisateur ou un article
    if (isset($_GET['delete_user'])) {
        $id_utilisateur = intval($_GET['delete_user']);
        $pdo->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = :id_utilisateur")->execute([':id_utilisateur' => $id_utilisateur]);
        header('Location: admin_dashboard.php');
        exit();
    }

    if (isset($_GET['delete_article'])) {
        $id_article = intval($_GET['delete_article']);
        $pdo->prepare("DELETE FROM Article WHERE id_article = :id_article")->execute([':id_article' => $id_article]);
        header('Location: admin_dashboard.php');
        exit();
    }

} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php"; ?>

    <div class="container mt-5">
        <h1 class="mb-4">Tableau de Bord Administrateur</h1>

        <!-- Liste des clients -->
        <div class="card mb-4">
            <div class="card-header">Liste des Clients</div>
            <div class="card-body">
                <?php if (count($clients) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clients as $index => $client): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($client['nom']) ?></td>
                                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                                    <td><?= htmlspecialchars($client['email']) ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $client['id_utilisateur'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                                        <a href="?delete_user=<?= $client['id_utilisateur'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun client trouvé.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Liste des vendeurs -->
        <div class="card mb-4">
            <div class="card-header">Liste des Vendeurs</div>
            <div class="card-body">
                <?php if (count($vendeurs) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vendeurs as $index => $vendeur): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($vendeur['nom']) ?></td>
                                    <td><?= htmlspecialchars($vendeur['prenom']) ?></td>
                                    <td><?= htmlspecialchars($vendeur['email']) ?></td>
                                    <td>
                                        <a href="edit_user.php?id=<?= $vendeur['id_utilisateur'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                                        <a href="?delete_user=<?= $vendeur['id_utilisateur'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun vendeur trouvé.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Liste des articles -->
        <div class="card">
            <div class="card-header">Liste des Articles</div>
            <div class="card-body">
                <?php if (count($articles) > 0): ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Catégorie</th>
                                <th>Prix</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $index => $article): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= htmlspecialchars($article['nom']) ?></td>
                                    <td><?= htmlspecialchars($article['categorie']) ?></td>
                                    <td><?= number_format($article['prix'], 2) ?> €</td>
                                    <td><?= htmlspecialchars($article['statut']) ?></td>
                                    <td>
                                        <a href="edit_article.php?id=<?= $article['id_article'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                                        <a href="?delete_article=<?= $article['id_article'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucun article trouvé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>

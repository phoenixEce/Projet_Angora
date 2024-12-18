<?php
session_start();

// Vérification si l'utilisateur est connecté et est administrateur
if (!isset($_SESSION['id_utilisateur']) || $_SESSION['type_utilisateur'] !== 'Administrateur') {
    header('Location: signin.php'); // Redirection si l'utilisateur n'est pas administrateur
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id_admin = $_SESSION['id_utilisateur'];

    // Récupérer les informations de l'administrateur
    $stmtAdmin = $pdo->prepare("SELECT * FROM Utilisateur WHERE id_utilisateur = :id_utilisateur AND type_utilisateur = 'Administrateur'");
    $stmtAdmin->execute([':id_utilisateur' => $id_admin]);
    $admin = $stmtAdmin->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        die("Administrateur introuvable.");
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
        <h1 class="mb-4">Bienvenue, <?= htmlspecialchars($admin['nom'] . ' ' . $admin['prenom']) ?></h1>

        <!-- Informations de l'administrateur -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Vos Informations</div>
            <div class="card-body">
                <p><strong>Nom :</strong> <?= htmlspecialchars($admin['nom']) ?></p>
                <p><strong>Prénom :</strong> <?= htmlspecialchars($admin['prenom']) ?></p>
                <p><strong>Email :</strong> <?= htmlspecialchars($admin['email']) ?></p>
                <p><strong>Téléphone :</strong> <?= htmlspecialchars($admin['telephone']) ?></p>
                <p><strong>Adresse :</strong> <?= htmlspecialchars($admin['adresse']) ?></p>
                <p><strong>Type d'utilisateur :</strong> <?= htmlspecialchars($admin['type_utilisateur']) ?></p>
            </div>
        </div>

        <!-- Actions supplémentaires -->
        <div class="text-center">
            <a href="manage_users.php" class="btn btn-success">Gérer les Utilisateurs</a>
        </div>
    </div>

    <?php include "footer.php"; ?>
</body>
</html>

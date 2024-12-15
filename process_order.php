<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

session_start();
$error_message = '';
$success_message = '';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['id_utilisateur'])) {
        header('Location: signin.php'); // Redirige vers la page de connexion
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupération des données du formulaire
        $id_acheteur = $_SESSION['id_utilisateur'];
        $id_article = htmlspecialchars($_POST['id_article']);
        $montant = htmlspecialchars($_POST['montant']);
        $mode_paiement = htmlspecialchars($_POST['mode_paiement']);
        $date_transaction = date('Y-m-d H:i:s');
        $statut_transaction = 'Reussie'; // Défini par défaut

        // Validation des champs obligatoires
        if (empty($id_article) || empty($montant) || empty($mode_paiement)) {
            $error_message = 'Veuillez remplir tous les champs obligatoires.';
        } elseif (!is_numeric($id_article) || !is_numeric($montant)) {
            $error_message = 'Les données fournies sont invalides.';
        } else {
            // Vérifier si l'article existe
            $checkArticle = $pdo->prepare("SELECT COUNT(*) FROM Article WHERE id_article = :id_article");
            $checkArticle->execute([':id_article' => $id_article]);
            if ($checkArticle->fetchColumn() == 0) {
                $error_message = 'Article non trouvé.';
            } else {
                // Insertion dans la table Transaction
                $sql = "INSERT INTO Transaction (id_acheteur, id_article, montant, date_transaction, mode_paiement, statut_transaction) 
                        VALUES (:id_acheteur, :id_article, :montant, :date_transaction, :mode_paiement, :statut_transaction)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':id_acheteur' => $id_acheteur,
                    ':id_article' => $id_article,
                    ':montant' => $montant,
                    ':date_transaction' => $date_transaction,
                    ':mode_paiement' => $mode_paiement,
                    ':statut_transaction' => $statut_transaction
                ]);

                // Message de succès
                $success_message = 'Commande enregistrée avec succès !';
            }
        }
    }
} catch (PDOException $e) {
    $error_message = 'Une erreur est survenue lors du traitement de votre commande.';
    error_log($e->getMessage(), 3, 'errors.log'); // Enregistre les erreurs dans un fichier
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($error_message): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php elseif ($success_message): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>
        <a href="index.php" class="btn btn-primary mt-3">Retour à l'accueil</a>
    </div>
</body>
</html>

<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: signin.php');
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

    $id_acheteur = $_SESSION['id_utilisateur'];

    // Récupérer les articles dans le panier
    $stmt = $pdo->prepare("SELECT p.id_panier, a.id_article, a.nom, a.prix, p.quantite, (a.prix * p.quantite) AS total FROM Panier p JOIN Article a ON p.id_article = a.id_article WHERE p.id_acheteur = :id_acheteur");
    $stmt->execute([':id_acheteur' => $id_acheteur]);
    $panier = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcul du total de la commande
    $totalCommande = 0;
    foreach ($panier as $item) {
        $totalCommande += $item['total'];
    }

    // Gestion de la validation de la commande
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $code_postal = htmlspecialchars($_POST['code_postal']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $email = htmlspecialchars($_POST['email']);
        $mode_paiement = htmlspecialchars($_POST['mode_paiement']);
        $date_transaction = date('Y-m-d H:i:s');

        // Validation des champs
        if (empty($nom) || empty($prenom) || empty($code_postal) || empty($adresse) || empty($telephone) || empty($email)) {
            $error_message = "Tous les champs de facturation sont obligatoires.";
        } elseif (!in_array($mode_paiement, ['Carte', 'Cheque-cadeau'])) {
            $error_message = "Mode de paiement invalide.";
        } else {
            try {
                $pdo->beginTransaction();

                // Insérer une transaction pour chaque article du panier
                $stmt = $pdo->prepare("INSERT INTO Transaction (id_acheteur, id_article, montant, date_transaction, mode_paiement, statut_transaction) VALUES (:id_acheteur, :id_article, :montant, :date_transaction, :mode_paiement, 'Reussie')");

                foreach ($panier as $item) {
                    $stmt->execute([
                        ':id_acheteur' => $id_acheteur,
                        ':id_article' => $item['id_article'],
                        ':montant' => $item['total'],
                        ':date_transaction' => $date_transaction,
                        ':mode_paiement' => $mode_paiement,
                    ]);
                }

                // Vider le panier
                $deleteStmt = $pdo->prepare("DELETE FROM Panier WHERE id_acheteur = :id_acheteur");
                $deleteStmt->execute([':id_acheteur' => $id_acheteur]);

                $pdo->commit();
                header('Location: confirmation.php?success=1');
                exit();
            } catch (Exception $e) {
                $pdo->rollBack();
                $error_message = "Erreur lors de la validation de la commande : " . $e->getMessage();
            }
        }
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
    <title>Validation de commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Validation de commande</h1>

    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row">
            <div class="col-md-6">
                <h3>Détails de facturation</h3>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="code_postal" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="code_postal" name="code_postal" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="telephone" name="telephone" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <div class="col-md-6">
                <h3>Récapitulatif de commande</h3>

                <?php foreach ($panier as $item): ?>
                    <div class="d-flex justify-content-between">
                        <div><?= htmlspecialchars($item['nom']) ?> (x<?= $item['quantite'] ?>)</div>
                        <div><?= number_format($item['total'], 2) ?> €</div>
                    </div>
                <?php endforeach; ?>

                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Total :</strong>
                    <strong><?= number_format($totalCommande, 2) ?> €</strong>
                </div>

                <div class="mt-4">
                    <h5>Moyen de paiement</h5>
                    <select name="mode_paiement" class="form-select" required>
                        <option value="Carte">Carte</option>
                        <option value="Cheque-cadeau">Chèque-cadeau</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-4">Valider la commande</button>
    </form>
</div>
</body>
</html>

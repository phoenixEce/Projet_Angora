<?php
session_start();
require_once 'db_connection.php';
require_once 'header.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_utilisateur'])) {
    header('Location: signin.php');
    exit();
}

// Initialisation des messages
$error_message = '';
$success_message = '';

try {
    $user_id = $_SESSION['id_utilisateur'];

    // Récupération des données actuelles de l'utilisateur
    $stmt = $connection->prepare("SELECT nom, prenom, email, adresse_ligne1, mot_de_passe FROM utilisateur WHERE id_utilisateur = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Traitement du formulaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $adresse = trim($_POST['adresse']);
        $current_password = $_POST['current_password'] ?? '';
        $new_password = $_POST['new_password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validation des champs obligatoires
        if (empty($nom) || empty($prenom) || empty($email)) {
            $error_message = "Veuillez remplir tous les champs obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Adresse e-mail invalide.";
        } else {
            // Vérifier si l'adresse e-mail est unique
            $stmt = $connection->prepare("SELECT id_utilisateur FROM utilisateur WHERE email = ? AND id_utilisateur != ?");
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            if ($stmt->get_result()->num_rows > 0) {
                $error_message = "Cette adresse e-mail est déjà utilisée.";
            } else {
                // Mise à jour des informations de base
                $stmt = $connection->prepare("UPDATE utilisateur SET nom = ?, prenom = ?, email = ?, adresse_ligne1 = ? WHERE id_utilisateur = ?");
                $stmt->bind_param("ssssi", $nom, $prenom, $email, $adresse, $user_id);
                $stmt->execute();
                $stmt->close();

                // Mise à jour du mot de passe si fourni
                if (!empty($current_password) && !empty($new_password)) {
                    if (password_verify($current_password, $user['mot_de_passe'])) {
                        if ($new_password === $confirm_password) {
                            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $stmt = $connection->prepare("UPDATE utilisateur SET mot_de_passe = ? WHERE id_utilisateur = ?");
                            $stmt->bind_param("si", $hashed_password, $user_id);
                            $stmt->execute();
                            $stmt->close();
                            $success_message = "Profil et mot de passe mis à jour avec succès.";
                        } else {
                            $error_message = "Les nouveaux mots de passe ne correspondent pas.";
                        }
                    } else {
                        $error_message = "Mot de passe actuel incorrect.";
                    }
                } else {
                    $success_message = "Profil mis à jour avec succès.";
                }
            }
        }
    }
} catch (Exception $e) {
    $error_message = "Erreur lors de la mise à jour : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier votre profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-control { background-color: #f8f9fa; padding: 12px; }
        .btn-primary { background-color: #00a8ff; border: none; padding: 12px 24px; }
        .btn-secondary { background-color: #0d1f2d; border: none; padding: 12px 24px; }
        h1 { color: #00a8ff; font-size: 24px; margin-bottom: 30px; }
        .form-label { font-weight: 500; margin-bottom: 8px; }
    </style>
</head>
<body>
<div class="container py-5">
    <h1>Modifier votre profil</h1>

    <?php if ($error_message): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
    <?php elseif ($success_message): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
    <?php endif; ?>

    <form action="profile.php" method="POST">
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="col-md-6">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" value="<?= htmlspecialchars($user['adresse_ligne1']) ?>">
            </div>
        </div>
        <div class="mb-4">
            <h5>Modifier le mot de passe</h5>
            <div class="mb-3">
                <input type="password" class="form-control" name="current_password" placeholder="Mot de passe actuel">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="new_password" placeholder="Nouveau mot de passe">
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" name="confirm_password" placeholder="Confirmer votre nouveau mot de passe">
            </div>
        </div>
        <div class="d-flex justify-content-end gap-3">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </div>
    </form>
</div>

<?php include "footer.php"; ?>
</body>
</html>

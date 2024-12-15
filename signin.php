<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = 'root';

session_start();
$error_message = '';

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];


        $sql = "SELECT * FROM Utilisateur WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {

            if (password_verify($password, $user['mot_de_passe'])) {

                $_SESSION['id_utilisateur'] = $user['id_utilisateur'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['type_utilisateur'] = $user['type_utilisateur'];

                if ($user['type_utilisateur'] == "Vendeur") {
                    header('Location: vendeur/dashboard_sales.php');
                } elseif ($user['type_utilisateur'] == "Client") {
                    header('Location: index.php');
                }elseif ($user['type_utilisateur'] == "Administrateur") {
                    header('Location: dashboard_admin.php');
                }


                //header('Location: index.php');
                exit();
            } else {
                $error_message = 'Mot de passe incorrect.';
            }
        } else {
            $error_message = "Aucun utilisateur trouvé avec cet email.";
        }
    }
} catch (PDOException $e) {
    $error_message = 'Erreur : ' . $e->getMessage();
}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Agora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Login Form Section -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <div class="text-center mb-4">
                        <h1 class="logo">Logo Agora</h1>
                    </div>

                    <h2 class="text-center mb-2 h3 fw-bolder">Connexion à votre compte</h2>
                    <p class="text-center text-muted mb-4">Heureux de vous revoir!</p>

                    <form action="signin.php" method="POST">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/email-icon.svg" alt="Email" width="20">
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/lock-icon.svg" alt="Password" width="20">
                                </span>
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <img src="assets/eye-icon.svg" alt="Show password" width="20">
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>

                        <p class="text-center mb-0">
                            Vous n'avez pas de compte?
                            <a href="register.php" class="text-primary text-decoration-none">Créer un compte</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Image Section -->
            <div class="col-md-6 d-none d-md-block p-0">
                <div class="image-container">
                    <img src="images/montre1.png"
                        alt="Luxury Watch"
                        class="img-cover">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'agora';
$username = 'root'; 
$password = ''; 

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $ville = htmlspecialchars($_POST['ville']);
        $code_postal = htmlspecialchars($_POST['code_postal']);
        $pays = htmlspecialchars($_POST['pays']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $type_utilisateur = htmlspecialchars($_POST['type_utilisateur']);

        
        $sql = "INSERT INTO Utilisateur (nom, prenom, email, mot_de_passe, adresse_ligne1, ville, code_postal, pays, numero_telephone, type_utilisateur) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse_ligne1, :ville, :code_postal, :pays, :numero_telephone, :type_utilisateur)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $password,
            ':adresse_ligne1' => $adresse,
            ':ville' => $ville,
            ':code_postal' => $code_postal,
            ':pays' => $pays,
            ':numero_telephone' => $telephone,
            ':type_utilisateur' => $type_utilisateur
        ]);

        
        header('Location: signin.php');
        exit();
    }
} catch (PDOException $e) {
    
    header('Location: register.php?error=' . urlencode('Erreur: ' . $e->getMessage()));
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte - Agora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <!-- Registration Form Section -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="login-container">
                    <div class="text-center mb-4">
                        <h1 class="logo">Logo Agora</h1>
                    </div>

                    <h2 class="text-center mb-2 h3 fw-bolder">Créer un compte</h2>
                    <p class="text-center text-muted mb-4">Bienvenue!</p>

                    <?php if (isset($_GET['error'])): ?>
                        <div class="alert alert-danger">
                            <?php echo htmlspecialchars($_GET['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form action="register.php" method="POST" id="registerForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <img src="assets/user-icon.svg" alt="Nom" width="20">
                                    </span>
                                    <input type="text" class="form-control" name="nom" placeholder="Nom" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <img src="assets/map-icon.svg" alt="Adresse" width="20">
                                    </span>
                                    <input type="text" class="form-control" name="adresse" placeholder="Adresse" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <img src="assets/user-icon.svg" alt="Prénom" width="20">
                                    </span>
                                    <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <img src="assets/city-icon.svg" alt="Ville" width="20">
                                    </span>
                                    <input type="text" class="form-control" name="ville" placeholder="Ville" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/email-icon.svg" alt="Email" width="20">
                                </span>
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                    <span class="input-group-text bg-white">
                                        <img src="assets/postal-icon.svg" alt="Code Postal" width="20">
                                    </span>
                                    <input type="text" class="form-control" name="code_postal" placeholder="Code Postal" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/email-icon.svg" alt="Confirm Email" width="20">
                                </span>
                                <input type="email" class="form-control" name="confirm_email" placeholder="Confirmer Email" required>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/globe-icon.svg" alt="Pays" width="20">
                                </span>
                                <input type="text" class="form-control" name="pays" placeholder="Pays" required>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/lock-icon.svg" alt="Password" width="20">
                                </span>
                                <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <img src="assets/eye-icon.svg" alt="Show password" width="20">
                                </button>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/phone-icon.svg" alt="Téléphone" width="20">
                                </span>
                                <input type="tel" class="form-control" name="telephone" placeholder="Numéro de téléphone" required>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/lock-icon.svg" alt="Confirm Password" width="20">
                                </span>
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirmer le mot de passe" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <img src="assets/eye-icon.svg" alt="Show password" width="20">
                                </button>
                            </div>
                            </div>
                            <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <img src="assets/user-type-icon.svg" alt="Type utilisateur" width="20">
                                </span>
                                <select class="form-select" name="type_utilisateur" required>
                                    <option value="">Type utilisateur</option>
                                    <option value="administrateur">Administrateur</option>
                                    <option value="vendeur">Vendeur</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">Créer un compte</button>

                        <p class="text-center mb-0">
                            Avez-vous déjà un compte?
                            <a href="signin.php" class="text-primary text-decoration-none">Se connecter</a>
                        </p>
                    </form>
                </div>
            </div>

            <!-- Image Section -->
            <div class="col-md-6 d-none d-md-block p-0">
                <div class="image-container">
                    <img src="images/montre 1.png"
                        alt="Luxury Watch"
                        class="img-cover">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="assets/js/main.js"></script>
</body>

</html>
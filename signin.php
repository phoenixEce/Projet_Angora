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

                    <form action="login.php" method="POST">
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
                    <img src="images/montre 1.png" 
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
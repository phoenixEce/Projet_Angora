<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Agora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .login-container {
            min-height: 100vh;
        }
        .form-control {
            border-radius: 0.5rem;
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
        }
        .watch-image {
            background-image: url('https://v0.dev/placeholder.svg?height=1080&width=1080');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row login-container">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-100 max-w-400 px-4">
                    <h2 class="text-center mb-4 fw-bold">Logo Agora</h2>
                    <h1 class="h3 mb-3 fw-bold">Connexion à votre compte</h1>
                    <p class="text-muted mb-4">Heureux de vous revoir!</p>
                    <form>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                                    </svg>
                                </span>
                                <input type="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                                    </svg>
                                </span>
                                <input type="password" class="form-control" placeholder="Mot de passe" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-3">Se connecter</button>
                    </form>
                    <p class="text-center">
                        Vous n'avez pas de compte? 
                        <a href="#" class="text-primary">Créer un compte</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block p-0">
                <div class="watch-image h-100">
                    <img src="images/montre 1.png" 
                         alt="Luxury Watch" 
                         class="img-cover">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
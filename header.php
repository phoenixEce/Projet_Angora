<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Démarrer la session si elle n'est pas déjà démarrée
}

ob_start(); // Activer la mise en tampon de sortie pour éviter les problèmes de redirection
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGORA FRANCIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arima:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        @font-face {
            font-family: Integral-CF;
            src: url('fonts/Integral-CF/Fontspring-DEMO-integralcf-extrabold.otf');
            src: url('fonts/Integral-CF/Fontspring-DEMO-integralcf-bold.otf');
            src: url('fonts/Integral-CF/Fontspring-DEMO-integralcf-heavy.otf');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fff;
            margin: 0px;
        }

        .title {
            font-family: 'Integral-CF', sans-serif;
            font-size: 4.5em;
            font-weight: bold;
            line-height: 1.2;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 20px;
            padding-left: 2.5rem;
        }

        .form-control-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-icon {
            padding: 0.375rem;
            line-height: 1;
        }

        .main-content p {
            font-size: 24px;
            color: #666;
        }

        .main-content .price {
            font-size: 72px;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #00aaff;
            border: none;
            border-radius: 25px;
            padding: 0.5rem 2rem;
            font-size: 18px;
        }

        .it {
            font-weight: normal;
            font-family: "Arima", system-ui;
        }

        /* Style de la Sidebar */
        .sidebar {
            width: 220px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* Full height */

            position: fixed;
            top: 0;
            left: 0;
            /* S'assure qu'elle prend toute la hauteur de l'écran */
            overflow-y: auto;
            /* Permet le défilement interne si le contenu dépasse */
            background-color: #f8f9fa;
            /* Ajoute une couleur de fond pour la démarquer */
            z-index: 1030;
            /* Assure qu'elle est devant les autres éléments */
            border-right: 1px solid #ddd;
            /* Ajoute une bordure pour démarquer visuellement */
        }

        .nav-link {
            color: #000;
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .nav-link:hover {
            color: #000;
        }

        .nav-link i {
            font-size: 18px;
        }

        .dropdown-toggle::after {
            margin-left: auto;
            transform: rotate(-90deg);
        }

        .dropdown-toggle.show::after {
            transform: rotate(0);
        }

        .dropdown-menu {
            position: static !important;
            border: none;
            padding-left: 28px;
            transform: none !important;
            padding-top: 0;
            padding-bottom: 0;
        }

        .dropdown-item {
            color: #666;
            padding: 6px 0;
            font-size: 13px;
        }

        .dropdown-item:hover {
            background: none;
            color: #333;
        }

        /* Settings link at bottom */
        .settings-container {
            margin-top: auto;
            padding-top: 16px;
            border-top: 1px solid #eee;
        }

        .settings-link {
            color: #666 !important;
            font-size: 14px;
        }

        .settings-link i {
            color: #666;
        }

        /* Animation for dropdown */
        .dropdown-menu {
            display: none;
        }

        .dropdown-menu.show {
            display: block;
            animation: fadeIn 0.2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /*Product Part*/

        .product-card {
            border: 1px solid #eaeaea;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
            transition: transform 0.3s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        .product-card img {
            width: 100%;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .content {
            margin-left: 15%;
            padding: 20px;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
        }

        .header h1 {
            font-size: 2.5rem;
            margin: 0;
        }

        .header p {
            font-size: 1rem;
            color: #6c757d;
        }

        .timer div {
            text-align: center;
            font-size: 1.5rem;
        }


        .rating {
            display: flex;
            align-items: center;
            gap: 4px;
            margin-bottom: 8px;
        }

        .stars {
            color: #ffc107;
            font-size: 14px;
        }

        .rating-text {
            color: #666;
            font-size: 14px;
            margin-left: 4px;
        }

        /* Style pour les étoiles vides */
        .bi-star-half {
            position: relative;
            display: inline-block;
        }

        .bi-star-half::before {
            color: #ffc107;
        }

        /* Counting */

        .countdown-container {
            padding: 20px;
            max-width: 800px;
        }

        .today-badge {
            background-color: #007bff;
            color: white;
            padding: 4px 5px;
            border-radius: 2px;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
            margin-right: 10px;
        }

        .content-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .titleCounting {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0;
            margin-right: 20px;
        }

        .countdown {
            display: flex;
            gap: 8px;
            align-items: flex-start;
        }

        .countdown-item {
            text-align: center;
            min-width: 60px;
        }

        .countdown-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 4px;
        }

        .countdown-value {
            font-size: 32px;
            font-weight: bold;
            padding: 8px;
            border-radius: 6px;
            min-width: 60px;
            display: inline-block;
        }

        .countdown-separator {
            font-size: 32px;
            font-weight: bold;
            color: #dc3545;
            margin-top: 32px;
        }

        @media (max-width: 768px) {
            .content-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .title {
                margin-bottom: 20px;
            }
        }

        /* Categories */

        .category-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 50px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
        }

        .category-card:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .category-icon {
            font-size: 24px;
            margin-bottom: 16px;
            color: #333;
        }

        .category-title {
            font-size: 14px;
            color: #333;
            margin: 0;
            font-weight: 500;
        }

        .cards-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .col-md-3 {
                margin-bottom: 16px;
            }
        }

        /* testimonies */
        .reviews-section {
            padding: 40px 20px;
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navigation-arrows {
            display: flex;
            gap: 12px;
        }

        .nav-arrow {
            width: 40px;
            height: 40px;
            border: 1px solid #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: white;
            transition: all 0.3s ease;
        }

        .nav-arrow:hover {
            background: #f8f8f8;
        }

        .reviews-container {
            display: flex;
            gap: 24px;
            overflow-x: hidden;
        }

        .review-card {
            min-width: 300px;
            flex: 1;
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .stars {
            color: #ffc107;
            margin-bottom: 16px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
        }

        .user-name {
            font-weight: 600;
            font-size: 16px;
            margin: 0;
        }

        .verified-badge {
            color: #28a745;
        }

        .review-text {
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
        }

        @media (max-width: 768px) {
            .reviews-container {
                overflow-x: auto;
                padding-bottom: 20px;
            }

            .review-card {
                min-width: 280px;
            }
        }

        /* Footer */
        footer {
            background-color: #f8f8f8;
            padding: 60px 0 20px;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer-logo-link {
            color: #333;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-description {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .footer-heading {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #333;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }

        .social-links a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #000;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        .social-links a:hover {
            opacity: 0.8;
        }

        .phone-number {
            font-size: 16px;
            color: #333;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .footer-bottom {
            border-top: 1px solid #e0e0e0;
            padding-top: 20px;
            margin-top: 40px;
        }

        .copyright {
            color: #666;
            font-size: 14px;
        }

        .payment-methods {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .payment-methods img {
            height: 24px;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .footer-section {
                margin-bottom: 40px;
            }
        }

        
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-2">
                <div class="sidebar">
                    <nav class="nav flex-column">
                        <!-- Home -->
                        <a href="index.php" class="nav-link">
                            <i class="bi bi-house-door"></i>
                            <span>Home</span>
                        </a>

                        <!-- Catégorie Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-folder"></i>
                                <span>Catégorie</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Articles rares</a></li>
                                <li><a class="dropdown-item" href="#">Articles haut de gammes</a></li>
                                <li><a class="dropdown-item" href="#">Articles réguliers</a></li>
                            </ul>
                        </div>

                        <!-- Filtrer Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-sliders"></i>
                                <span>Filtrer</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Achat immédiat</a></li>
                                <li><a class="dropdown-item" href="#">Transactions</a></li>
                                <li><a class="dropdown-item" href="#">Meilleure offre</a></li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Settings at bottom -->
                    <div class="settings-container">
                        <a href="signin.php" class="nav-link settings-link">
                            <i class="bi bi-gear"></i>
                            <span>Paramètres</span>
                        </a>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-folder"></i>
                                <span>Utilisateurs</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Clients</a></li>
                                <li><a class="dropdown-item" href="#">Vendeurs</a></li>
                                <li><a class="dropdown-item" href="#">Articles réguliers</a></li>
                            </ul>
                        </div>

                        <!-- Filtrer Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-sliders"></i>
                                <span>Ventes</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Ventes aux enchères</a></li>
                                <li><a class="dropdown-item" href="#">Transactions</a></li>
                                <li><a class="dropdown-item" href="#">Achat immediat</a></li>
                            </ul>
                        </div>
                        <a href="index.php" class="nav-link">
                            <i class="bi bi-house-door"></i>
                            <span>Messages</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <header class="border-bottom">
                    <nav class="navbar navbar-expand-lg navbar-light bg-white bg-light">
                        <div class="container">
                            <a class="navbar-brand fw-bold title" href="#">AGORA FRANCIA</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link it" href="index.php">Accueil</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle it" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Tout parcourir
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item it" href="#">Option 1</a></li>
                                            <li><a class="dropdown-item it" href="#">Option 2</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link it" href="notification.php">Notifications</a>
                                    </li>
                                </ul>
                                <form class="d-flex me-3 position-relative">
                                    <input class="form-control" type="search" placeholder="Rechercher" aria-label="Search">
                                    <i class="bi bi-search form-control-icon"></i>
                                </form>
                                <div class="d-flex">
                                    <button class="btn btn-icon me-2"><i class="bi bi-person fs-5"></i></button>
                                    <button class="btn btn-icon me-2" onclick="window.location.href='cart.php'">
                                         <i class="bi bi-cart fs-5"></i>
                                    </button>
                                    <button class="btn btn-icon"><i class="bi bi-bell fs-5"></i></button>
                                </div>
                            </div>
                        </div>
                    </nav>
                </header>
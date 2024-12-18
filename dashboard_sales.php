<?php
include "header.php";
include "db_connection.php"; // Connexion à la base de données

// Requête pour compter les articles rares
$articles_rare_query = "SELECT COUNT(*) AS count FROM article WHERE categorie = 'Articles rares' AND statut = 'Disponible'";
$articles_rare_result = mysqli_query($connection, $articles_rare_query);
$articles_rare_count = mysqli_fetch_assoc($articles_rare_result)['count'];

// Requête pour compter les articles haut de gamme
$articles_haut_de_gamme_query = "SELECT COUNT(*) AS count FROM article WHERE categorie = 'Articles haut de gamme' AND statut = 'Disponible'";
$articles_haut_de_gamme_result = mysqli_query($connection, $articles_haut_de_gamme_query);
$articles_haut_de_gamme_count = mysqli_fetch_assoc($articles_haut_de_gamme_result)['count'];

// Requête pour compter les articles réguliers
$articles_reguliers_query = "SELECT COUNT(*) AS count FROM article WHERE categorie = 'Articles reguliers' AND statut = 'Disponible'";
$articles_reguliers_result = mysqli_query($connection, $articles_reguliers_query);
$articles_reguliers_count = mysqli_fetch_assoc($articles_reguliers_result)['count'];

// Requête pour compter les achats immédiats
$achats_immediats_query = "SELECT COUNT(*) AS count FROM transaction WHERE mode_paiement = 'Carte' AND statut_transaction = 'Reussie'";
$achats_immediats_result = mysqli_query($connection, $achats_immediats_query);
$achats_immediats_count = mysqli_fetch_assoc($achats_immediats_result)['count'];

// Requête pour compter les achats par transaction (achats réussis)
$achats_par_transaction_query = "SELECT COUNT(*) AS count FROM transaction WHERE statut_transaction = 'Reussie'";
$achats_par_transaction_result = mysqli_query($connection, $achats_par_transaction_query);
$achats_par_transaction_count = mysqli_fetch_assoc($achats_par_transaction_result)['count'];

// Requête pour compter les achats par meilleure offre
$achats_par_meilleure_offre_query = "SELECT COUNT(*) AS count FROM negotiation WHERE statut_negotiation = 'Conclue'";
$achats_par_meilleure_offre_result = mysqli_query($connection, $achats_par_meilleure_offre_query);
$achats_par_meilleure_offre_count = mysqli_fetch_assoc($achats_par_meilleure_offre_result)['count'];

?>

<style>
    .welcome-text {
        text-align: end;
        font-size: 20px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .stat-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 24px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .stat-title {
        color: #666;
        font-size: 16px;
        margin-bottom: 12px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: bold;
        color: #333;
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>

<body class="bg-light">
    <div class="container py-4">
        <h4 class="welcome-text mb-5">Bienvenue! <span class="text-primary">Njeunkam Sandrine</span></h4>

        <div class="stats-grid">

            <!-- Articles rares -->
            <a href="product-list-sales.php"><div class="stat-card">
                <div class="stat-title">Articles rares</div>
                <div class="stat-value"><?php echo $articles_rare_count; ?></div>
            </div></a>

            <!-- Articles haut de gamme -->
            <div class="stat-card">
                <div class="stat-title">Articles haut de gamme</div>
                <div class="stat-value"><?php echo $articles_haut_de_gamme_count; ?></div>
            </div>

            <!-- Achats immédiats -->
            <div class="stat-card">
                <div class="stat-title">Achats immédiats</div>
                <div class="stat-value"><?php echo $achats_immediats_count; ?></div>
            </div>

            <!-- Achats par transaction -->
            <div class="stat-card">
                <div class="stat-title">Achats par transaction</div>
                <div class="stat-value"><?php echo $achats_par_transaction_count; ?></div>
            </div>

            <!-- Achats par meilleure offre -->
            <div class="stat-card">
                <div class="stat-title">Achats par meilleure offre</div>
                <div class="stat-value"><?php echo $achats_par_meilleure_offre_count; ?></div>
            </div>

            <!-- Articles réguliers -->
            <div class="stat-card">
                <div class="stat-title">Articles réguliers</div>
                <div class="stat-value"><?php echo $articles_reguliers_count; ?></div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>

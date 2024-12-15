<?php
include "header.php";
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
            <a href="vendeur/product-list-sales.php"><div class="stat-card">
                <div class="stat-title">Articles rares</div>
                <div class="stat-value">50</div>
            </div></a>

            <!-- Articles haut de gamme -->
            <div class="stat-card">
                <div class="stat-title">Articles haut de gamme</div>
                <div class="stat-value">100</div>
            </div>

            <!-- Achats immédiats -->
            <div class="stat-card">
                <div class="stat-title">Achats immédiats</div>
                <div class="stat-value">300</div>
            </div>

            <!-- Achats par transaction -->
            <div class="stat-card">
                <div class="stat-title">Achats par transaction</div>
                <div class="stat-value">100</div>
            </div>

            <!-- Achats par meilleure offre -->
            <div class="stat-card">
                <div class="stat-title">Achats par meilleure offre</div>
                <div class="stat-value">50</div>
            </div>

            <!-- Articles réguliers -->
            <div class="stat-card">
                <div class="stat-title">Articles réguliers</div>
                <div class="stat-value">500</div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>
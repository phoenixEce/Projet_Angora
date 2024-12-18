<?php
include 'header.php';

include 'db_connection.php';


// Récupérer les articles depuis la base de données

/* $query = "SELECT * FROM article WHERE statut = 'disponible' AND categorie IS NOT NULL";
$result = mysqli_query($connection, $query);

 */




?>

<style>
    .product-card {
        background: #f8f8f8;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .product-image-container {
        position: relative;
        padding-top: 100%;
        /* 1:1 Aspect Ratio */
        background: #fff;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-actions {
        position: absolute;
        top: 12px;
        right: 12px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: white;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .action-btn:hover {
        background: #f0f0f0;
    }

    .action-btn.favorite.active {
        color: #dc3545;
    }

    .product-info {
        padding: 16px;
    }

    .product-title {
        font-size: 16px;
        font-weight: 500;
        margin-bottom: 8px;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 8px;
    }

    .rating-stars {
        color: #ffc107;
    }

    .rating-value {
        color: #666;
        font-size: 14px;
    }

    .product-price {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .product-type {
        font-size: 14px;
        color: #666;
        margin-bottom: 16px;
    }

    .add-to-cart {
        width: 100%;
        padding: 12px;
        background: #000;
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .add-to-cart:hover {
        background: #333;
    }

    .cart-icon {
        margin-right: 8px;
    }

    .category-button {
        margin: 5px;
        min-width: 100px;
        font-size: 1rem;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-md-8 text-center">
            <button class="btn add-to-cart category-button" data-category="haut de gamme">Articles haut de gamme</button>
            <button class="btn add-to-cart category-button" data-category="reguliers">Articles reguliers</button>
            <button class="btn add-to-cart category-button" data-category="Articles rares">Articles rares</button>
        </div>
    </div>
    <div class="row g-4">


        <div class="row g-4" id="product-container">
            <!-- Les produits seront injectés ici -->
        </div>
    </div>
</div>
</div>

<?php
include "footer.php";
?>

<!-- Bootstrap JS -->
<script>
    // Toggle favorite buttons
    document.querySelectorAll('.favorite').forEach(button => {
        button.addEventListener('click', function() {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            if (this.classList.contains('active')) {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
            } else {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".category-button").on("click", function() {
            const category = $(this).data("category");
            // Mettre en surbrillance le bouton actif
            $(".category-button").removeClass("active");
            $(this).addClass("active");

            // Appel AJAX pour récupérer les produits
            $.ajax({
                url: "fetch_products_by_cat.php", // Fichier pour récupérer les données
                method: "POST",
                data: {
                    category: category
                },
                beforeSend: function() {
                    $("#product-container").html("<p class='text-info'>Chargement des produits...</p>");
                },
                success: function(response) {
                    $("#product-container").html(response);
                },
                error: function() {
                    $("#product-container").html("<div class='alert alert-danger'>Erreur lors du chargement des produits.</div>");
                }
            });
        });
    });
</script>

</body>

</html>
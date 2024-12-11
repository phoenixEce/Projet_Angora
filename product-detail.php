<?php
include "header.php";
?>
<style>
    .product-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .product-image {
        width: 100%;
        border-radius: 8px;
        background: #000;
    }

    .product-title {
        font-size: 32px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .rating-container {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .stars {
        color: #ffc107;
    }

    .review-count {
        color: #666;
    }

    .stock-status {
        color: #0dcaf0;
    }

    .product-price {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .product-description {
        color: #333;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .quantity-input {
        width: 80px;
        text-align: center;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 8px;
    }

    .quantity-btn {
        width: 40px;
        height: 40px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .quantity-btn:hover {
        background: #f8f9fa;
    }

    .buy-button {
        width: 200px;
        padding: 12px;
        background: #0dcaf0;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .buy-button:hover {
        background: #0bb5d9;
    }

    .info-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .info-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .info-title {
        font-weight: 600;
        margin: 0;
    }

    .info-link {
        color: #0dcaf0;
        text-decoration: none;
    }

    .info-link:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>
    <div class="product-container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Couronne en diamant" class="product-image">
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <h1 class="product-title">Couronne en diamant</h1>

                <div class="rating-container">
                    <div class="stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                    </div>
                    <span class="review-count">(150 Reviews)</span>
                    <span class="stock-status">En Stock</span>
                </div>

                <div class="product-price">399€</div>

                <p class="product-description">
                    Couronne en diamant de très bonne qualité, alliant élégance et raffinement,
                    idéale pour les occasions spéciales ou pour sublimer votre collection de bijoux
                </p>

                <div class="quantity-selector">
                    <button class="quantity-btn" onclick="decrementQuantity()">-</button>
                    <input type="number" value="2" min="1" class="quantity-input" id="quantity">
                    <button class="quantity-btn" onclick="incrementQuantity()">+</button>
                </div>

                <button class="buy-button mb-4">Acheter</button>

                <!-- Delivery Info -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="bi bi-truck" style="font-size: 1.5rem;"></i>
                        <h3 class="info-title">Free Delivery</h3>
                    </div>
                    <a href="#" class="info-link">Enter your postal code for Delivery Availability</a>
                </div>

                <!-- Returns Info -->
                <div class="info-card">
                    <div class="info-header">
                        <i class="bi bi-arrow-counterclockwise" style="font-size: 1.5rem;"></i>
                        <h3 class="info-title">Retour et livraison</h3>
                    </div>
                    <p class="mb-0">Retour sous 30 jours. <a href="#" class="info-link">Voir les details</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="T-shirt" class="product-image">
                        <div class="product-actions">
                            <button class="action-btn favorite">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="action-btn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title">T-shirt</h2>
                        <div class="product-rating">
                            <div class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <span class="rating-value">3.5/5</span>
                        </div>
                        <div class="product-type">Achat immédiat</div>
                        <div class="product-price">120€</div>
                        <button class="add-to-cart">
                            <i class="bi bi-cart cart-icon"></i>
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Pantalon jeans femme" class="product-image">
                        <div class="product-actions">
                            <button class="action-btn favorite active">
                                <i class="bi bi-heart-fill"></i>
                            </button>
                            <button class="action-btn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title">Pantalon jeans femme</h2>
                        <div class="product-rating">
                            <div class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <span class="rating-value">3.5/5</span>
                        </div>
                        <div class="product-type">Achat par ransactions</div>
                        <div class="product-price">190€</div>
                        <button class="add-to-cart">
                            <i class="bi bi-cart cart-icon"></i>
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-image-container">
                        <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Rolex" class="product-image">
                        <div class="product-actions">
                            <button class="action-btn favorite">
                                <i class="bi bi-heart"></i>
                            </button>
                            <button class="action-btn">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="product-info">
                        <h2 class="product-title">Rolex</h2>
                        <div class="product-rating">
                            <div class="rating-stars">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                                <i class="bi bi-star"></i>
                            </div>
                            <span class="rating-value">3.5/5</span>
                        </div>
                        <div class="product-type">Achat immédiat</div>
                        <div class="product-price">18500€</div>
                        <button class="add-to-cart">
                            <i class="bi bi-cart cart-icon"></i>
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include "footer.php";
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decrementQuantity() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }
    </script>
</body>

</html>
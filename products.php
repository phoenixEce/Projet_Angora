<?php
    include 'header.php';
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
            padding-top: 100%; /* 1:1 Aspect Ratio */
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
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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
    </style>

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
</body>
</html>
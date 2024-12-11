<?php
    include "header.php";
?>
    <style>
/*         .form-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 12px;
        }

        .form-label {
            color: #666;
            margin-bottom: 8px;
        } */

        .required::after {
            content: "*";
            color: #dc3545;
            margin-left: 4px;
        }

        .order-summary {
            background: #fff;
            border-radius: 8px;
            padding: 24px;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }

        .payment-methods {
            display: flex;
            gap: 12px;
            margin-top: 12px;
        }

        .payment-methods img {
            height: 24px;
            object-fit: contain;
        }

        .promo-container {
            display: flex;
            gap: 12px;
            margin: 24px 0;
        }

        .btn-apply {
            background: #0dcaf0;
            color: white;
            border: none;
            padding: 8px 24px;
            border-radius: 4px;
        }

        .btn-order {
            background: #0dcaf0;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 4px;
            width: 100%;
        }

        .btn-cancel {
            background: #052c65;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 4px;
            width: 100%;
        }

        .warning-text {
            color: #dc3545;
            font-size: 14px;
            margin-top: 24px;
        }
    </style>
</head>
<body>
    <div class="form-container mt-4">
        <form>
            <div class="row">
                <!-- Left Column - Personal Details -->
                <div class="col-md-6 mb-4">
                    <h2 class="mb-4">Détails de facturation</h2>
                    
                    <div class="mb-3">
                        <label class="form-label required">Nom</label>
                        <input type="text" class="form-control p-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Prénom</label>
                        <input type="text" class="form-control p-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Code postal</label>
                        <input type="text" class="form-control p-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Adresse</label>
                        <input type="text" class="form-control p-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Numéro de téléphone</label>
                        <input type="tel" class="form-control p-3" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control p-3" required>
                    </div>
                </div>

                <!-- Right Column - Order Summary -->
                <div class="col-md-6">
                    <div class="order-summary">
                        <!-- Products -->
                        <div class="product-item">
                            <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="LCD Monitor" class="product-image">
                            <div class="flex-grow-1">LCD Monitor</div>
                            <div class="fw-bold">650€</div>
                        </div>

                        <div class="product-item">
                            <img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="H1 Gamepad" class="product-image">
                            <div class="flex-grow-1">H1 Gamepad</div>
                            <div class="fw-bold">1100€</div>
                        </div>

                        <!-- Totals -->
                        <div class="d-flex justify-content-between mb-2">
                            <div>Livraison:</div>
                            <div>Gratuite</div>
                        </div>

                        <div class="d-flex justify-content-between mb-4">
                            <div>Sous total:</div>
                            <div class="fw-bold">1750€</div>
                        </div>

                        <!-- Payment Options -->
                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment" id="bank">
                                <label class="form-check-label" for="bank">
                                    Bank
                                </label>
                            </div>
                            <div class="payment-methods">
                                <img src="assets/visa-logo-svgrepo-com.svg" alt="Visa">
                                <img src="assets/mastercard-svgrepo-com.svg" alt="Mastercard">
                                <img src="assets/paypal-svgrepo-com.svg" alt="PayPal">
                                <img src="assets/apple-pay-svgrepo-com.svg" alt="Apple Pay">
                                <img src="assets/google-pay-primary-logo-logo-svgrepo-com.svg" alt="Google Pay">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="delivery" checked>
                                <label class="form-check-label" for="delivery">
                                    Payer à la livraison
                                </label>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="promo-container">
                            <input type="text" class="form-control" placeholder="Code promo">
                            <button type="button" class="btn-apply">Appliquer</button>
                        </div>

                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-4">
                            <div class="fw-bold">Total:</div>
                            <div class="fw-bold">1750€</div>
                        </div>

                        <!-- Terms -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" required>
                                <label class="form-check-label">
                                    J'ai lu et j'accepte les conditions générales et la politique de confidentialité
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox">
                                <label class="form-check-label">
                                    Sauvegarder ces informations pour un vérification rapide la prochaine fois
                                </label>
                            </div>
                        </div>

                        <p class="warning-text">
                            <i class="bi bi-exclamation-circle"></i>
                            Les commandes sont définitives et ne peuvent être annulées après 24 heures.
                        </p>

                        <!-- Action Buttons -->
                        <div class="row g-2 mt-4">
                            <div class="col">
                                <button type="submit" class="btn-order">Commander</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn-cancel">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <?php
    include "footer.php";
?>
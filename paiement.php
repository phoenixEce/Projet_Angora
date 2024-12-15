<?php
include "header.php";
?>
<style>
    .form-control {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        padding: 12px;
    }

    .form-label {
        color: #666;
        margin-bottom: 8px;
    }

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

    .payment-logo {
        width: 50px;
        height: auto;
        margin: 0 10px;
    }

    #successMessage,
    #alertMessage {
        display: none;
    }
</style>
</head>

<body>
    <div class="form-container mt-4">
        <form id="billingForm">
            <div class="row">
                <!-- Left Column - Personal Details -->
                <div class="col-md-6 mb-4">
                    <h2 class="mb-4">Détails de facturation</h2>
                    <div class="mb-3">
                        <label class="form-label required">Nom</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Prénom</label>
                        <input type="text" class="form-control" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Code postal</label>
                        <input type="text" class="form-control" name="postal_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Adresse</label>
                        <input type="text" class="form-control" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Numéro de téléphone</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control" name="email" required>
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
                                <input class="form-check-input" type="radio" name="payment" id="bank" value="bank" required>
                                <label class="form-check-label" for="bank">Bank</label>
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
                                <input class="form-check-input" type="radio" name="payment" id="delivery" value="delivery" checked required>
                                <label class="form-check-label" for="delivery">Payer à la livraison</label>
                            </div>
                        </div>
                        <!-- Promo Code -->
                        <div class="promo-container">
                            <input type="text" class="form-control" id="promoCode" placeholder="Code promo">
                            <button type="button" class="btn-apply" id="applyPromoButton">Appliquer</button>
                        </div>
                        <!-- Total -->
                        <div class="d-flex justify-content-between mb-4">
                            <div class="fw-bold">Total:</div>
                            <div class="fw-bold" id="totalDisplay">1750€</div>
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
                                <button type="button" class="btn-order" id="commanderBtn">Commander</button>
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

    <!-- Modal de Paiement -->
    <div
        class="modal fade"
        id="paymentModal"
        tabindex="-1"
        aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">
                        Veuillez entrer vos informations de paiement
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Message d'alerte -->
                    <div class="alert alert-success d-none" id="successMessage">
                        Les éléments ont été ajoutés avec succès !
                    </div>
                    <div class="alert alert-danger d-none" id="alertMessage"></div>
                    <!-- Logos de paiement -->
                    <div class="text-center mb-3">
                        <img src="./images/visa.png" alt="Visa" class="payment-logo" />
                        <img
                            src="./images/CB.jpg"
                            alt="CB"
                            class="payment-logo" />
                        <img src="./images/paypal.png" alt="PayPal" class="payment-logo" />
                        <img
                            src="./images/applepay.png"
                            alt="Apple Pay"
                            class="payment-logo" />
                        <img
                            src="./images/googlePay.png"
                            alt="Google Pay"
                            class="payment-logo" />
                    </div>
                    <form id="paymentForm">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="name">Nom *</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    required
                                    pattern="[A-Za-z\s]+"
                                    title="Veuillez entrer uniquement des lettres." />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cardNumber">N° de carte *</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="cardNumber"
                                    required
                                    pattern="\d{16}"
                                    title="Le numéro de carte doit comporter 16 chiffres." />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="expiryDate">Date d'expiration *</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="expiryDate"
                                    placeholder="MM/AA"
                                    required
                                    pattern="(0[1-9]|1[0-2])\/\d{2}"
                                    title="Format requis : MM/AA." />
                            </div>
                            <div class="form-group col-md-12">
                                <label for="securityCode">N° de sécurité *</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="securityCode"
                                    required
                                    pattern="\d{3,4}"
                                    title="Le code de sécurité doit comporter 3 ou 4 chiffres." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input
                                type="text"
                                class="form-control"
                                value="1750€"
                                id="totalAmount"
                                readonly />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        data-dismiss="modal"
                        id="cancelButton">
                        Annuler
                    </button>
                    <button
                        type="button"
                        class="btn btn-primary"
                        id="validateButton">
                        Valider
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS + jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#commanderBtn').click(function() {
                // Vérifiez si le formulaire de facturation est valide
                if ($('#billingForm')[0].checkValidity()) {
                    const paymentMethod = $('input[name="payment"]:checked').val();
                    if (paymentMethod === 'bank') {
                        $('#paymentModal').modal('show'); // Afficher le modal de paiement par carte
                    } else {
                        alert('Vous avez choisi de payer à la livraison.');
                    }
                } else {
                    alert('Veuillez remplir tous les champs requis.');
                }
            });

            $('#validateButton').click(function() {
                const name = $('#name').val();
                const cardNumber = $('#cardNumber').val();
                const expiryDate = $('#expiryDate').val();
                const securityCode = $('#securityCode').val();

                // Vérifiez si tous les champs de paiement sont remplis
                if (name && cardNumber && expiryDate && securityCode) {
                    $('#successMessage').removeClass('d-none').show().delay(3000).fadeOut(function() {
                        $('#paymentModal').modal('hide'); // Fermer le pop-up après 3 secondes
                    });
                    $('#alertMessage').hide();
                } else {
                    $('#alertMessage').removeClass('d-none').show().text('Veuillez remplir tous les champs correctement.');
                    $('#successMessage').hide();
                }
            });
            // Fermeture du modal via le bouton Annuler
            $('#cancelButton').click(function() {
                $('#paymentModal').modal('hide'); // Fermer le modal de paiement
            });

        });
        //code promo 

        $(document).ready(function() {
            // Récupérer le montant total initial à partir du champ Total
            let originalTotal = parseFloat($('#totalAmount').val().replace('€', '').replace(',', '.'));

            $('#applyPromoButton').click(function() {
                const promoCode = $('#promoCode').val();
                let discount = 0;

                // Exemple de codes promo
                if (promoCode === 'PROMO10') {
                    discount = 10; // 10% de réduction
                } else if (promoCode === 'PROMO20') {
                    discount = 20; // 20% de réduction
                } else {
                    alert('Code promo invalide.');
                    return;
                }

                // Calcul de la réduction
                const newTotal = originalTotal - (originalTotal * (discount / 100));
                $('#totalAmount').val(newTotal.toFixed(2) + '€'); // Mise à jour du total
            });
        });

        $(document).ready(function() {
            // Montant total initial
            let originalTotal = 1750;

            // Mettre à jour le champ total
            $('#totalDisplay').text(originalTotal + '€');

            $('#applyPromoButton').click(function() {
                const promoCode = $('#promoCode').val();
                let discount = 0;

                // Exemple de codes promo
                if (promoCode === 'PROMO10') {
                    discount = 10; // 10% de réduction
                } else if (promoCode === 'PROMO20') {
                    discount = 20; // 20% de réduction
                } else {
                    alert('Code promo invalide.');
                    return;
                }

                // Calcul de la réduction
                const newTotal = originalTotal - (originalTotal * (discount / 100));
                $('#totalDisplay').text(newTotal.toFixed(2) + '€'); // Mise à jour de l'affichage du total
            });
        });
    </script>
</body>
<?php
include "footer.php";
?>
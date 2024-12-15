<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos différents produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-list {
            max-width: 1200px;
            margin: 30px auto;
        }
        .header-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .blue-bar {
            width: 4px;
            height: 24px;
            background-color: #00a8ff;
        }
        .product-item {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }
        .product-image {
            width: 100%;
            max-width: 130px;
            height: auto;
            object-fit: cover;
        }
        .product-info {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 100%;
        }
        .stock-status {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
        }
        .in-stock {
            color: #00b894;
        }
        .out-of-stock {
            color: #00a8ff;
        }
        .btn-buy {
            background-color: #00a8ff;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
        }
        .btn-delete {
            background-color: #000;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
        }
        .btn-buy-all {
            background-color: #00a8ff;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
        }
        .total-amount {
            background-color: #00b894;
            color: white;
            padding: 8px 20px;
            border-radius: 4px;
        }
        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        @media (max-width: 768px) {
            .product-info {
                margin-top: 15px;
            }
            .header-actions {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="product-list">
            <!-- Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="header-title">
                        <div class="blue-bar"></div>
                        <h2 class="m-0">Vos différents produits</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="header-actions justify-content-md-end">
                        <span class="total-amount mb-2 mb-md-0">Total: 879€</span>
                        <button class="btn-buy-all">Tout acheter</button>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="products-container">
                <!-- Product 1 -->
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            <img src="couronne.jpg" alt="Couronne en diamant" class="product-image img-fluid">
                        </div>
                        <div class="col-md-10 col-sm-8">
                            <div class="product-info">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="h5 mb-2">Couronne en diamant</h3>
                                        <p class="text-muted mb-2">Achat par vente immédiat</p>
                                        <button class="btn-buy mb-3 mb-md-0">Acheter</button>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <p class="h5 mb-2">399€</p>
                                        <p class="stock-status in-stock mb-2">En stock</p>
                                        <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal1">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            <img src="jeans.jpg" alt="Pantalons jeans femme" class="product-image img-fluid">
                        </div>
                        <div class="col-md-10 col-sm-8">
                            <div class="product-info">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="h5 mb-2">Pantalons jeans femme</h3>
                                        <p class="text-muted mb-2">Achat par vente immédiat</p>
                                        <button class="btn-buy mb-3 mb-md-0">Acheter</button>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <p class="h5 mb-2">129€</p>
                                        <p class="stock-status in-stock mb-2">En stock</p>
                                        <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal2">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="product-item">
                    <div class="row">
                        <div class="col-md-2 col-sm-4">
                            <img src="robe.jpg" alt="Robe d'opéra femme" class="product-image img-fluid">
                        </div>
                        <div class="col-md-10 col-sm-8">
                            <div class="product-info">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="h5 mb-2">Robe d'opéra femme</h3>
                                        <p class="text-muted mb-2">Achat par vente immédiat</p>
                                        <button class="btn-buy mb-3 mb-md-0">Acheter</button>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <p class="h5 mb-2">299€</p>
                                        <p class="stock-status out-of-stock mb-2">Stock épuisé</p>
                                        <button class="btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal3">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal for Product 1 -->
    <div class="modal fade" id="deleteModal1" tabindex="-1" aria-labelledby="deleteModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel1">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer la Couronne en diamant ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="deleteProduct(1)">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal for Product 2 -->
    <div class="modal fade" id="deleteModal2" tabindex="-1" aria-labelledby="deleteModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel2">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer les Pantalons jeans femme ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="deleteProduct(2)">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal for Product 3 -->
    <div class="modal fade" id="deleteModal3" tabindex="-1" aria-labelledby="deleteModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel3">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer la Robe d'opéra femme ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="deleteProduct(3)">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function deleteProduct(productId) {
            // Ici, vous pouvez ajouter la logique pour supprimer le produit
            console.log(`Suppression du produit ${productId}`);
            // Fermer le modal
            var modal = bootstrap.Modal.getInstance(document.getElementById(`deleteModal${productId}`));
            modal.hide();
            // Vous pouvez ajouter ici la logique pour retirer le produit de la liste
        }
    </script>
</body>
</html>


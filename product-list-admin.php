<?php
include "header.php";
?>

<style>
    .product-table {
        margin-top: 30px;
    }

    .table-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .title-indicator {
        width: 4px;
        height: 24px;
        background-color: #0dcaf0;
        margin-right: 10px;
    }

    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
    }

    .status-available {
        background-color: #d1e7dd;
        color: #0f5132;
    }

    .status-sold {
        background-color: #0dcaf0;
        color: white;
    }

    .status-negotiation {
        background-color: #f8d7da;
        color: #842029;
    }

    .action-icon {
        color: #6c757d;
        font-size: 18px;
        margin-right: 10px;
        cursor: pointer;
    }

    .add-product-btn {
        background-color: #0dcaf0;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 5px;
        margin-top: 20px;
    }

    .modal-title {
        font-size: 16px;
        color: #333;
        text-align: center;
        width: 100%;
    }

    .form-label {
        font-size: 14px;
        color: #333;
        margin-bottom: 4px;
    }

    .form-label::after {
        content: "*";
        color: red;
        margin-left: 2px;
    }

    .form-control,
    .form-select {
        border: 1px solid #ccc;
        border-radius: 4px;
        padding: 8px 12px;
        font-size: 14px;
    }

    .photo-upload {
        text-align: center;
        margin-top: 20px;
    }

    .photo-upload-text {
        color: #0dcaf0;
        cursor: pointer;
        text-decoration: underline;
        font-size: 14px;
    }

    .photo-label {
        color: #666;
        font-size: 14px;
        margin-left: 10px;
    }

    .modal-footer {
        justify-content: center;
        border-top: none;
        padding-top: 0;
        gap: 10px;
    }

    .btn-validate {
        background-color: #ff4757;
        border: none;
        padding: 8px 24px;
        color: white;
        border-radius: 4px;
        font-size: 14px;
    }

    .btn-cancel {
        background-color: #2f3542;
        border: none;
        padding: 8px 24px;
        color: white;
        border-radius: 4px;
        font-size: 14px;
    }

    .modal-content {
        padding: 20px;
    }

    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .btn-close {
        display: none;
    }
</style>

<div class="container">
    <div class="product-table">
        <div class="table-title">
            <div class="title-indicator"></div>
            Vos différents produits
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Type de vente</th>
                        <th>Photo</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Robe</td>
                        <td>Robe opéra rouge</td>
                        <td>Article rare</td>
                        <td>299€</td>
                        <td>Achat immédiat</td>
                        <td><img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Robe" class="product-image"></td>
                        <td><span class="status-badge status-available">Disponible</span></td>
                        <td>
                            <i class="bi bi-trash action-icon" onclick="showDeleteModal()"></i>
                            <i class="bi bi-pencil action-icon" onclick="showEditModal()"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Couronne</td>
                        <td>En diamant</td>
                        <td>Haut de gamme</td>
                        <td>399€</td>
                        <td>Transactions</td>
                        <td><img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Couronne" class="product-image"></td>
                        <td><span class="status-badge status-sold">Vendu</span></td>
                        <td>
                            <i class="bi bi-trash action-icon" onclick="showDeleteModal()"></i>
                            <i class="bi bi-pencil action-icon" onclick="showEditModal()"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>Montre</td>
                        <td>Rolex</td>
                        <td>Article réguliers</td>
                        <td>1800€</td>
                        <td>Meilleure offre</td>
                        <td><img src="images/closeup-shot-modern-cool-black-digital-watch-with-brown-leather-strap.jpg" alt="Montre" class="product-image"></td>
                        <td><span class="status-badge status-negotiation">En négociation</span></td>
                        <td>
                            <i class="bi bi-trash action-icon" onclick="showDeleteModal()"></i>
                            <i class="bi bi-pencil action-icon" onclick="showEditModal()"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="add-product-btn" onclick="showAddModal()">Ajouter un produit</button>
    </div>
</div>

<!-- Add/Edit Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Veuillez entrer les informations de votre produit</h5>
            </div>
            <div class="modal-body">
                <form id="productForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Catégorie</label>
                                <select class="form-select" id="productCategory" required>
                                    <option value="Article rare">Article rare</option>
                                    <option value="Haut de gamme">Haut de gamme</option>
                                    <option value="Article réguliers">Article réguliers</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productSaleType" class="form-label">Type de vente</label>
                                <select class="form-select" id="productSaleType" required>
                                    <option value="Achat immédiat">Achat immédiat</option>
                                    <option value="Transactions">Transactions</option>
                                    <option value="Meilleure offre">Meilleure offre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="productDescription" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Prix</label>
                                <input type="number" class="form-control" id="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="productStatus" class="form-label">Statut</label>
                                <input type="text" class="form-control" id="productStatus" required>
                            </div>
                        </div>
                    </div>
                    <div class="photo-upload">
                        <input type="file" id="productImage" class="d-none" accept="image/*">
                        <label for="productImage" class="photo-upload-text">Cliquez ici pour ajouter une photo</label>
                        <span class="photo-label">URL de la photo</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-validate" onclick="saveProduct()">Valider</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer ce produit ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-validate" onclick="deleteProduct()">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast container -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto">Succès</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Opération réussie !
        </div>
    </div>
</div>

<script>
    function showAddModal() {
        document.getElementById('productForm').reset();
        document.querySelector('.modal-title').textContent = "Veuillez entrer les informations de votre produit";
        var modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }

    function showEditModal() {
        // Here you would typically populate the form with the product's current data
        document.querySelector('.modal-title').textContent = "Modifier les informations du produit";
        var modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }

    function showDeleteModal() {
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function saveProduct() {
        // Here you would typically save the product data
        var modal = bootstrap.Modal.getInstance(document.getElementById('productModal'));
        modal.hide();
        showToast('Produit sauvegardé avec succès !');
    }

    function deleteProduct() {
        // Here you would typically delete the product
        var modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        modal.hide();
        showToast('Produit supprimé avec succès !');
    }

    function showToast(message) {
        var toastEl = document.getElementById('successToast');
        var toast = new bootstrap.Toast(toastEl);
        toastEl.querySelector('.toast-body').textContent = message;
        toast.show();
    }

    // Handle file input change
    document.getElementById('productImage').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const fileName = e.target.files[0].name;
            document.querySelector('.photo-label').textContent = fileName;
        }
    });
</script>

<?php
include "footer.php";
?>
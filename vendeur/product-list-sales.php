<?php
include "header.php";

include '../db_connection.php';

$query = "SELECT * FROM article";
$result = mysqli_query($connection, $query);
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
                    <?php
                    // Vérifier si des résultats ont été retournés
                    if ($result->num_rows > 0) {
                        // Parcourir les résultats et générer les lignes du tableau
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['categorie']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['type_vente']) . "</td>";
                            echo "<td><img src='../" . htmlspecialchars($row['photo_url']) . "' alt='" . htmlspecialchars($row['nom']) . "' class='product-image'></td>";
                            echo "<td><span class='status-badge status-" . strtolower(htmlspecialchars($row['statut'])) . "'>" . htmlspecialchars($row['statut']) . "</span></td>";
                            echo "<td>
                        <i class='bi bi-trash action-icon' onclick='showDeleteModal({$row['id_article']})'></i>
                        <i class='bi bi-pencil action-icon' onclick='showEditModal({$row['id_article']})'></i>
                      </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Aucun produit trouvé.</td></tr>";
                    }
                    ?>
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
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="productCategory" class="form-label">Catégorie</label>
                                <select class="form-select" id="productCategory" name="productCategory" required>
                                    <option value="Articles rares">Articles rares</option>
                                    <option value="Articles haut de gamme">Articles haut de gamme</option>
                                    <option value="Articles réguliers">Articles réguliers</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="productSaleType" class="form-label">Type de vente</label>
                                <select class="form-select" id="productSaleType" name="productSaleType" required>
                                    <option value="Achat immédiat">Achat immédiat</option>
                                    <option value="Negotiation">Negotiation</option>
                                    <option value="Meilleure offre">Meilleure offre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="productDescription" name="productDescription" required>
                            </div>
                            <div class="mb-3">
                                <label for="productPrice" class="form-label">Prix</label>
                                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="productStatus" class="form-label">Statut</label>
                                <input type="text" class="form-control" id="productStatus" name="productStatus" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="productSellerId" class="form-label">Date de début</label>
                        <input type="date" class="form-control" id="productStartDate" name="productStartDate">
                    </div>
                    <div class="mb-3">
                        <label for="productSellerId" class="form-label">Date de fin</label>
                        <input type="date" class="form-control" id="productEndDate" name="productEndDate">
                    </div>
                    <div class="photo-upload">
                        <input type="file" id="productImage" name="productImage" class="d-none" accept="image/*">
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

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier les informations du produit</h5>
            </div>
            <div class="modal-body">
                <form id="editProductForm">
                    <input type="hidden" id="editProductId" name="id"> <!-- Hidden field for product ID -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editProductName" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="editProductName" name="productName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductCategory" class="form-label">Catégorie</label>
                                <select class="form-select" id="editProductCategory" name="productCategory" required>
                                    <option value="" disabled selected>Choisissez une catégorie</option>
                                    <option value="Articles rares">Articles rares</option>
                                    <option value="Articles haut de gamme">Articles haut de gamme</option>
                                    <option value="Articles réguliers">Articles réguliers</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editProductSaleType" class="form-label">Type de vente</label>
                                <select class="form-select" id="editProductSaleType" name="productSaleType" required>
                                    <option value="Achat immédiat">Achat immédiat</option>
                                    <option value="Negotiation">Negotiation</option>
                                    <option value="Meilleure offre">Meilleure offre</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="editProductDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="editProductDescription" name="productDescription" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductPrice" class="form-label">Prix</label>
                                <input type="number" class="form-control" id="editProductPrice" name="productPrice" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductStatus" class="form-label">Statut</label>
                                <input type="text" class="form-control" id="editProductStatus" name="productStatus" required>
                            </div>
                        </div>
                    </div>
                    <div class="photo-upload">
                        <input type="file" id="editProductImage" name="productImage" class="d-none" accept="image/*">
                        <label for="editProductImage" class="photo-upload-text">Cliquez ici pour ajouter une photo</label>
                        <span class="photo-label-1">URL de la photo</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-validate" onclick="updateProduct()">Modifier</button>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Annuler</button>
            </div>
        </div>
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
                <button type="button" class="btn btn-validate" onclick="deleteArticle()">Supprimer</button>
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

    function showEditModal(productId) {
        // Récupérer les données du produit à partir de la base de données
        fetch(`controls/get_article.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // // Remplir le modal avec les données du produit
                    document.getElementById('editProductName').value = data.article.nom;
                    document.getElementById('editProductCategory').value = data.article.categorie;
                    document.getElementById('editProductSaleType').value = data.article.type_vente;
                    document.getElementById('editProductDescription').value = data.article.description;
                    document.getElementById('editProductPrice').value = data.article.prix;
                    document.getElementById('editProductStatus').value = data.article.statut;

                    // Ouvrir le modal
                    const editModal = new bootstrap.Modal(document.getElementById('editProductModal'));
                    editModal.show();
                } else {
                    alert('Erreur lors de la récupération des données du produit.');
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    function showDeleteModal() {
        var modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }

    function saveProduct() {
        const formData = new FormData(document.getElementById('productForm'));

        const productImage = document.getElementById('productImage').files[0];
        if (productImage) {
            formData.append('photo_url', productImage);
        }

        fetch('controls/add_article.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response:', response); // Ajoutez cette ligne
                return response.text();
            })
            .then(data => {
                console.log('Data:', data); // Ajoutez cette ligne
                if (data.success) {
                    $('#productModal').modal('hide');
                    showToast('Produit sauvegardé avec succès !');
                    location.reload(); // Rafraîchir la page pour voir le nouveau produit
                } else {
                    alert('Erreur lors de l\'ajout du produit : ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue. Veuillez réessayer.');
            });
    }

    function updateProduct() {
        const productId = 1;
        const productData = {
            nom: document.getElementById('editProductName').value,
            categorie: document.getElementById('editProductCategory').value,
            type_vente: document.getElementById('editProductSaleType').value,
            description: document.getElementById('editProductDescription').value,
            prix: document.getElementById('editProductPrice').value,
            statut: document.getElementById('editProductStatus').value,
            photo_url: document.getElementById('editProductImage').value,
        };

        console.log(productData);

        fetch(`controls/update_article.php?id=${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(productData),
            })
            .then(response => {
                //return response.json();
                // Affiche la réponse brute avant de tenter de la convertir en JSON
                return response.text(); // Essaie de convertir la réponse en JSON
            })
            .then(data => {
                console.log('Data:', data); // Ajoutez cette ligne
                if (data.success) {
                    alert('Produit mis à jour avec succès.');
                    // Fermer le modal
                    const editModal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
                    editModal.hide();
                    showToast('Produit mis à jour avec succès.');

                    // Rafraîchir la liste des produits ou mettre à jour l'affichage
                    loadProducts();
                } else {
                    alert('Erreur lors de la mise à jour du produit.');
                }
            })
            .catch(error => console.error('Erreur:', error.message));
    }

    function deleteArticle(articleId) {
        fetch('controls/delete_article.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id: articleId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Optionnel : mettre à jour l'interface utilisateur pour retirer l'article supprimé
                    document.getElementById(`article-${articleId}`).remove();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Erreur:', error));
    }

    /* function deleteProduct() {
        // Here you would typically delete the product
        var modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
        modal.hide();
        showToast('Produit supprimé avec succès !');
    } */

    function showToast(message) {
        var toastEl = document.getElementById('successToast');
        var toast = new bootstrap.Toast(toastEl);
        toastEl.querySelector('.toast-body').textContent = message;
        toast.show();
    }

    function handleCategoryChange() {
        const category = document.getElementById('productSaleType').value;
        const sDate = document.getElementById('productStartDate');
        const eDate = document.getElementById('productEndDate');

        // Afficher les champs uniquement si la catégorie est "Articles rares" ou "Articles haut de gamme"
        if (category === 'Meilleure offre' || category === 'Meilleure offre') {
            sDate.style.display = 'block';
            eDate.style.display = 'block';
        } else {
            sDate.style.display = 'none';
            eDate.style.display = 'none';
        }
    }

    // Handle file input change
    document.getElementById('productImage').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const fileName = e.target.files[0].name;
            document.querySelector('.photo-label').textContent = fileName;
        }
    });

    document.getElementById('editProductImage').addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const fileName = e.target.files[0].name;
            document.querySelector('.photo-label-1').textContent = fileName;
        }
    });
</script>

<?php
include "footer.php";
?>
<?php
include "header.php";
include '../db_connection.php';

$query = "SELECT id_article, id_vendeur, id_acheteur, offre_acheteur, contre_offre_vendeur, id_negotiation, statut_negotiation 
          FROM negotiation 
          WHERE id_vendeur = 1";
$result = mysqli_query($connection, $query);

function getStatusBadge($status) {
    switch ($status) {
        case 'En cours':
            return '<span class="badge bg-primary">En cours</span>';
        case 'En attente':
            return '<span class="badge bg-warning text-dark">En attente</span>';
        case 'Refusée':
            return '<span class="badge bg-danger">Refusée</span>';
        case 'Conclue':
            return '<span class="badge bg-success">Conclue</span>';
        default:
            return '<span class="badge bg-secondary">' . htmlspecialchars($status) . '</span>';
    }
}
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


    .action-button {
        padding: 5px 10px;
        margin: 2px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }

    .counter-offer-btn {
        background-color: #ffc107;
        color: #000;
    }

    .refuse-btn {
        background-color: #dc3545;
        color: #fff;
    }

    .close-btn {
        background-color: #28a745;
        color: #fff;
    }
</style>

<div class="container">
    <div class="product-table">
        <div class="table-title">
            <div class="title-indicator"></div>
            Vos négociations en cours
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID Article</th>
                        <th>ID Vendeur</th>
                        <th>ID Acheteur</th>
                        <th>Offre Acheteur</th>
                        <th>Contre Offre Vendeur</th>
                        <th>ID Négociation</th>
                        <th>Statut Négociation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id_article']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['id_vendeur']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['id_acheteur']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['offre_acheteur']) . "€</td>";
                            echo "<td>" . htmlspecialchars($row['contre_offre_vendeur']) . "€</td>";
                            echo "<td>" . htmlspecialchars($row['id_negotiation']) . "</td>";
                            echo "<td>" . getStatusBadge($row['statut_negotiation']) . "</td>";
                            echo "<td>
                                <button class='action-button counter-offer-btn' onclick='showCounterOfferModal({$row['id_negotiation']}, {$row['offre_acheteur']})'>Contre-offre</button>
                                <button class='action-button refuse-btn' onclick='showRefuseModal({$row['id_negotiation']})'>Refuser</button>
                                <button class='action-button close-btn' onclick='showCloseModal({$row['id_negotiation']})'>Clôturer</button>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>Aucune négociation en cours.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Counter Offer Modal -->
<div class="modal fade" id="counterOfferModal" tabindex="-1" aria-labelledby="counterOfferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="counterOfferModalLabel">Faire une contre-offre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="counterOfferInfo"></p>
                <div class="mb-3">
                    <label for="counterOfferAmount" class="form-label">Montant de la contre-offre</label>
                    <input type="number" class="form-control" id="counterOfferAmount" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="submitCounterOffer()">Envoyer</button>
            </div>
        </div>
    </div>
</div>

<!-- Refuse Offer Modal -->
<div class="modal fade" id="refuseModal" tabindex="-1" aria-labelledby="refuseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseModalLabel">Refuser l'offre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir refuser cette offre ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" onclick="submitRefuse()">Refuser</button>
            </div>
        </div>
    </div>
</div>

<!-- Close Negotiation Modal -->
<div class="modal fade" id="closeModal" tabindex="-1" aria-labelledby="closeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="closeModalLabel">Clôturer la négociation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir clôturer cette négociation ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" onclick="submitClose()">Clôturer</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentNegotiationId = null;

function showCounterOfferModal(negotiationId, buyerOffer) {
    currentNegotiationId = negotiationId;
    document.getElementById('counterOfferInfo').textContent = `Offre actuelle: ${buyerOffer}€`;
    document.getElementById('counterOfferAmount').value = '';
    new bootstrap.Modal(document.getElementById('counterOfferModal')).show();
}

function showRefuseModal(negotiationId) {
    currentNegotiationId = negotiationId;
    new bootstrap.Modal(document.getElementById('refuseModal')).show();
}

function showCloseModal(negotiationId) {
    currentNegotiationId = negotiationId;
    new bootstrap.Modal(document.getElementById('closeModal')).show();
}

function submitCounterOffer() {
    const amount = document.getElementById('counterOfferAmount').value;
    if (!amount || isNaN(amount) || amount <= 0) {
        alert('Veuillez entrer un montant valide.');
        return;
    }
    sendRequest('counter-offer', { amount: amount });
}

function submitRefuse() {
    sendRequest('refuse');
}

function submitClose() {
    sendRequest('close');
}

function sendRequest(action, data = {}) {
    data.negotiationId = currentNegotiationId;
    data.action = action;

    fetch('controls/process_negotiation.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur réseau');
        }
        return response.json();
    })
    .then(result => {
        if (result.success) {
            alert(result.message);
            location.reload(); // Refresh the page to show updated data
        } else {
            throw new Error(result.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue: ' + error.message);
    })
    .finally(() => {
        // Close all modals
        document.querySelectorAll('.modal').forEach(modal => {
            bootstrap.Modal.getInstance(modal).hide();
        });
    });
}
</script>

<?php
include "footer.php";
?>
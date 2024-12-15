<?php
include "../header.php";
include "../db_connection.php";


$user_id = $_SESSION['id_utilisateur'];

if (!isset($_GET['ID']) || !filter_var($_GET['ID'], FILTER_VALIDATE_INT)) {
    die("L'ID du produit est invalide ou manquant.");
}

$productId = (int)$_GET['ID'];

// Fonction pour logger les erreurs
function logError($message)
{
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, 'error.log');
}

function sendNotification($connection, $id_utilisateur, $message)
{
    $insert_query = "INSERT INTO notification (id_utilisateur, message, date_envoi, statut)
                        VALUES (?, ?, NOW(), 'Non lue')";
    $stmt = mysqli_prepare($connection, $insert_query);
    if (!$stmt) {
        logError("Erreur de préparation de la requête d'insertion de notification: " . mysqli_error($connection));
        return false;
    }
    mysqli_stmt_bind_param($stmt, "is", $id_utilisateur, $message);
    if (!mysqli_stmt_execute($stmt)) {
        logError("Erreur d'exécution de la requête d'insertion de notification: " . mysqli_stmt_error($stmt));
        mysqli_stmt_close($stmt);
        return false;
    }
    mysqli_stmt_close($stmt);
    return true;
}

// Fonction pour insérer ou mettre à jour une négociation
function insertOrUpdateNegotiation($connection, $id_article, $id_vendeur, $id_acheteur, $offre_acheteur)
{
    try {
        // Vérifier si une négociation active existe déjà
        $check_query = "SELECT id_negotiation, contre_offre_vendeur FROM negotiation 
                            WHERE id_article = ? AND id_vendeur = ? AND id_acheteur = ? AND statut_negotiation != 'Conclue'";
        $check_stmt = mysqli_prepare($connection, $check_query);
        if (!$check_stmt) {
            throw new Exception("Erreur de préparation de la requête de vérification: " . mysqli_error($connection));
        }
        mysqli_stmt_bind_param($check_stmt, "iii", $id_article, $id_vendeur, $id_acheteur);
        if (!mysqli_stmt_execute($check_stmt)) {
            throw new Exception("Erreur d'exécution de la requête de vérification: " . mysqli_stmt_error($check_stmt));
        }
        $result = mysqli_stmt_get_result($check_stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Mise à jour de la négociation existante
            $update_query = "UPDATE negotiation SET offre_acheteur = ?, statut_negotiation = 'En cours' 
                                WHERE id_negotiation = ?";
            $update_stmt = mysqli_prepare($connection, $update_query);
            if (!$update_stmt) {
                throw new Exception("Erreur de préparation de la requête de mise à jour: " . mysqli_error($connection));
            }
            mysqli_stmt_bind_param($update_stmt, "di", $offre_acheteur, $row['id_negotiation']);
            if (!mysqli_stmt_execute($update_stmt)) {
                throw new Exception("Erreur d'exécution de la requête de mise à jour: " . mysqli_stmt_error($update_stmt));
            }
            sendNotification($connection, $id_acheteur, "Offre mise à jour par le client à hauteur de " . $offre_acheteur . "$");
            mysqli_stmt_close($update_stmt);

            return [
                "success" => true,
                "message" => "Votre offre a été mise à jour avec succès.",
                "contre_offre_vendeur" => $row['contre_offre_vendeur'],
                "statut_negotiation" => "En cours"
            ];
        } else {
            // Insertion d'une nouvelle négociation
            $insert_query = "INSERT INTO negotiation (id_article, id_vendeur, id_acheteur, offre_acheteur, statut_negotiation) 
                                VALUES (?, ?, ?, ?, 'En cours')";
            $insert_stmt = mysqli_prepare($connection, $insert_query);
            if (!$insert_stmt) {
                throw new Exception("Erreur de préparation de la requête d'insertion: " . mysqli_error($connection));
            }
            mysqli_stmt_bind_param($insert_stmt, "iiid", $id_article, $id_vendeur, $id_acheteur, $offre_acheteur);
            if (!mysqli_stmt_execute($insert_stmt)) {
                throw new Exception("Erreur d'exécution de la requête d'insertion: " . mysqli_stmt_error($insert_stmt));
            }
            sendNotification($connection, 1, "Nouvelle Offre mise à jour par le client à hauteur de " . $offre_acheteur . "$");

            mysqli_stmt_close($insert_stmt);

            return [
                "success" => true,
                "message" => "Votre offre a été enregistrée avec succès.",
                "statut_negotiation" => "En cours"
            ];
        }
    } catch (Exception $e) {
        logError("Erreur dans insertOrUpdateNegotiation: " . $e->getMessage());
        return [
            "success" => false,
            "message" => "Une erreur est survenue lors du traitement de votre offre. Veuillez réessayer."
        ];
    } finally {
        if (isset($check_stmt)) mysqli_stmt_close($check_stmt);
    }
}

// Traitement de la soumission de l'offre
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['offer'])) {
    echo "Something";
    $sql = "SELECT id_vendeur FROM article WHERE id_article = " . $productId . ";";


    $result = mysqli_query($connection, $sql);
    $idVendeur = mysqli_fetch_assoc($result)['id_vendeur'];
    try {



        $id_article = $productId;
        $id_vendeur = $idVendeur;
        $id_acheteur = $user_id;
        $offre_acheteur = floatval($_POST['offer']);

        if ($offre_acheteur <= 0) {
            throw new Exception("Le montant de l'offre doit être supérieur à zéro.");
        }

        $result = insertOrUpdateNegotiation($connection, $id_article, $id_vendeur, $id_acheteur, $offre_acheteur);

        header('Content-Type: application/json');
        echo json_encode($result);
    } catch (Exception $e) {
        logError("Erreur lors du traitement de l'offre: " . $e->getMessage());
        header('Content-Type: application/json');
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
    }
    exit;
}

$query = "SELECT * FROM article WHERE id_article=" . $_GET['ID'] . ";";
$result = mysqli_query($connection, $query);
$product = mysqli_fetch_assoc($result);

// Récupérer la dernière négociation pour cet article
$last_negotiation_query = "SELECT offre_acheteur, contre_offre_vendeur, statut_negotiation 
                            FROM negotiation 
                            WHERE id_article = " . $_GET['ID'] . " AND id_acheteur = " . $user_id . " AND statut_negotiation != 'Conclue'
                            ORDER BY id_negotiation DESC LIMIT 1";
$last_negotiation_result = mysqli_query($connection, $last_negotiation_query);
$last_negotiation = mysqli_fetch_assoc($last_negotiation_result);

?>
<style>
    .product-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .welcome-message {
        margin-bottom: 24px;
        text-align: end;
    }

    .user-name {
        color: #0dcaf0;
    }

    .product-image {
        width: 100%;
        border-radius: 8px;
        background: #000;
        margin-bottom: 24px;
    }

    .product-title {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .rating {
        color: #ffc107;
        font-size: 20px;
        margin-bottom: 16px;
    }

    .product-description {
        color: #666;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .countdown-section {
        margin-bottom: 32px;
    }

    .countdown-title {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .countdown-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .countdown-item {
        text-align: center;
    }

    .countdown-value {
        font-size: 32px;
        font-weight: bold;
    }

    .countdown-separator {
        font-size: 32px;
        font-weight: bold;
        color: #dc3545;
    }

    .countdown-label {
        font-size: 12px;
        color: #666;
    }

    .price-section {
        margin-bottom: 32px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .price-label {
        font-size: 20px;
        font-weight: 600;
    }

    .price-value {
        font-size: 24px;
        font-weight: bold;
    }

    .offer-button {
        background: #0dcaf0;
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 6px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .offer-button:hover {
        background: #0bb5d9;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 24px;
        max-width: 400px;
        margin: 30px auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .modal-title {
        font-size: 18px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        text-align: center;
    }

    .success-message {
        color: #00b894;
        text-align: center;
        margin-bottom: 20px;
        font-size: 14px;
        display: none;
    }

    .amount-label {
        font-size: 14px;
        color: #333;
        margin-bottom: 8px;
    }

    .amount-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f5f5f5;
        font-size: 16px;
        margin-bottom: 24px;
    }

    .buttons-container {
        display: flex;
        justify-content: center;
        gap: 12px;
    }

    .btn-validate {
        background-color: #ff4757;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
    }

    .btn-cancel {
        background-color: #2f3542;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        cursor: pointer;
    }
</style>

<div class="product-container">
    <div class="welcome-message mb-5">
        Bienvenue! <span class="user-name"><?php echo $_SESSION['nom']; ?></span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <img src="../images/montre1.png" alt="<?php echo $product["nom"]; ?>" class="product-image">
        </div>

        <div class="col-md-6">
            <h1 class="product-title"><?php echo $product["nom"]; ?></h1>

            <div class="rating">
                <span>★</span><span>★</span><span>★</span><span>★</span><span>☆</span>
            </div>

            <p class="product-description"><?php echo $product["description"]; ?></p>

            <!--<div class="countdown-section">
                    <h2 class="countdown-title">Temps restant</h2>
                    <div class="countdown-container">
                        <div class="countdown-item">
                            <div class="countdown-value" id="days">03</div>
                            <div class="countdown-label">Jours</div>
                        </div>
                        <div class="countdown-separator">:</div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="hours">23</div>
                            <div class="countdown-label">Heures</div>
                        </div>
                        <div class="countdown-separator">:</div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="minutes">19</div>
                            <div class="countdown-label">Minutes</div>
                        </div>
                        <div class="countdown-separator">:</div>
                        <div class="countdown-item">
                            <div class="countdown-value" id="seconds">56</div>
                            <div class="countdown-label">Seconds</div>
                        </div>
                    </div>
                </div>-->

            <div class="price-section">
                <div class="price-row">
                    <div class="price-label">Prix fixé</div>
                    <div class="price-value"><?php echo $product["prix"]; ?>€</div>
                </div>
                <div class="negotiation-info">
                    <h3>État de la négociation</h3>
                    <?php if ($last_negotiation): ?>
                        <p>Votre dernière offre: <span class="offer-value"><?php echo $last_negotiation['offre_acheteur']; ?>€</span></p>
                        <?php if ($last_negotiation['contre_offre_vendeur']): ?>
                            <p>Contre-offre du vendeur: <span class="offer-value"><?php echo $last_negotiation['contre_offre_vendeur']; ?>€</span></p>
                        <?php endif; ?>
                        <p>Statut: <?php echo $last_negotiation['statut_negotiation']; ?></p>
                    <?php else: ?>
                        <p>Aucune négociation en cours.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            if ($last_negotiation && $last_negotiation['statut_negotiation'] == "Echouee") {
                /* echo '<button class="offer-button" onclick="openModal()">Proposer une offre</button>'; */
                echo "";
            } elseif ($last_negotiation && $last_negotiation['statut_negotiation'] == "Conclue") {
                echo '<button class="offer-button" onclick="openModal()">Proceder au paiement</button>';
            } elseif ($last_negotiation && $last_negotiation['statut_negotiation'] == "En cours") {
                echo '<button class="offer-button" onclick="openModal()">Proposer une offre</button>';
            } else {
                echo '<button class="offer-button" onclick="openModal()">Proposer une offre</button>';
            }
            ?>
            <!-- <button class="offer-button" onclick="openModal()">Proposer une offre</button> -->
        </div>
    </div>
</div>

<!-- Modal -->
<div id="offerModal" class="modal">
    <div class="modal-content">
        <h5 class="modal-title">Veuillez saisir votre montant</h5>
        <p id="successMessage" class="success-message"></p>
        <div class="form-group">
            <label class="amount-label">Montant</label>
            <input type="text" id="amountInput" class="amount-input" value="900€">
        </div>
        <div class="buttons-container">
            <button class="btn-validate" onclick="submitOffer()">Valider</button>
            <button class="btn-cancel" onclick="closeModal()">Annuler</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openModal() {
        document.getElementById('offerModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('offerModal').style.display = 'none';
        document.getElementById('successMessage').style.display = 'none';
    }

    function submitOffer() {
        const amount = document.getElementById('amountInput').value.replace('€', '').trim();

        if (isNaN(amount) || parseFloat(amount) <= 0) {
            document.getElementById('successMessage').textContent = "Veuillez entrer un montant valide supérieur à zéro.";
            document.getElementById('successMessage').style.color = '#ff4757';
            document.getElementById('successMessage').style.display = 'block';
            return;
        }

        const offerData = {
            offer: parseFloat(amount)
        };

        const params = new URLSearchParams();
        for (const [key, value] of Object.entries(offerData)) {
            params.append(key, value);
        }

        fetch('', {
                method: 'POST',

                body: params
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erreur réseau');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById('successMessage').textContent = data.message;
                    document.getElementById('successMessage').style.color = '#00b894';
                    updateNegotiationInfo(amount, data.contre_offre_vendeur, data.statut_negotiation);
                } else {
                    document.getElementById('successMessage').textContent = data.message;
                    document.getElementById('successMessage').style.color = '#00b894';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('successMessage').textContent = error.message;
                document.getElementById('successMessage').style.color = '#ff4757';
            })
            .finally(() => {
                document.getElementById('successMessage').style.display = 'block';
                setTimeout(() => {
                    document.getElementById('successMessage').style.display = 'none';
                    closeModal();
                }, 3000);
            });
    }

    function updateNegotiationInfo(newOffer, contreOffre, statut) {
        const negotiationInfo = document.querySelector('.negotiation-info');
        negotiationInfo.innerHTML = `
                    <h3>État de la négociation</h3>
                    <p>Votre dernière offre: <span class="offer-value">${newOffer}€</span></p>
                    ${contreOffre ? `<p>Contre-offre du vendeur: <span class="offer-value">${contreOffre}€</span></p>` : ''}
                    <p>Statut: ${statut || 'En cours'}</p>
                `;
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('offerModal')) {
            closeModal();
        }
    }
</script>

<!-- <script>
        // Set the countdown date (3 days, 23 hours, 19 minutes, 56 seconds from now)
        const countDownDate = new Date().getTime() + (3 * 24 * 60 * 60 * 1000) + (23 * 60 * 60 * 1000) + (19 * 60 * 1000) + (56 * 1000);

        // Update the countdown every second
        const countdown = setInterval(function() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            // Calculate days, hours, minutes, seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the results with leading zeros
            document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');

            // If the countdown is finished, display zeros
            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
            }
        }, 1000);
    </script> -->
<?php
include "../footer.php";
?>
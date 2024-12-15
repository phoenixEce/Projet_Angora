<?php
include "../header.php";
include "../db_connection.php"; // Connexion à la base de données


$user_id = $_SESSION['id_utilisateur'];

$id_utilisateur = $user_id;

// Si la notification est marquée comme lue, mettez à jour la base de données
if (isset($_POST['id_notification'])) {
    $id_notification = $_POST['id_notification'];

    // Mettre à jour la notification pour la marquer comme lue
    $update_query = "UPDATE notification SET statut = 'Lue' WHERE id_notification = ?";
    $stmt = mysqli_prepare($connection, $update_query);
    mysqli_stmt_bind_param($stmt, "i", $id_notification);
    $result = mysqli_stmt_execute($stmt);

    // Retourner une réponse JSON pour indiquer si l'opération a réussi
    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    exit(); // On s'arrête ici pour éviter d'afficher la page de notifications
}

// Extraire les notifications pour l'utilisateur
$notifications_query = "SELECT * FROM notification WHERE id_utilisateur = ?";
$stmt = mysqli_prepare($connection, $notifications_query);
mysqli_stmt_bind_param($stmt, "i", $id_utilisateur);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<style>
    .notifications-container {
        margin: 40px auto;
        padding: 0 20px;
    }

    .notifications-title {
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .title-indicator {
        width: 4px;
        height: 24px;
        background: #0dcaf0;
        border-radius: 2px;
    }

    .notification-item {
        display: flex;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        position: relative;
        /* Nécessaire pour placer un badge ou un point */
    }

    .notification-item.read {
        background-color: #f8f9fa;
        /* Couleur de fond pour les notifications lues */
    }

    .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #052c65;
        margin-right: 16px;
        overflow: hidden;
        position: relative;
    }

    .avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Point rouge pour les notifications non lues */
    .notification-item .notification-point {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background-color: #dc3545;
        border-radius: 50%;
    }

    .notification-content {
        flex-grow: 1;
    }

    .user-name {
        font-weight: 500;
        margin-bottom: 4px;
    }

    .notification-text {
        color: #666;
        font-size: 14px;
    }

    .notification-badge {
        background: #dc3545;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 500;
    }
</style>
<div class="notifications-container">
    <div class="notifications-title">
        <div class="title-indicator"></div>
        <h2 class="h5 mb-0">Uniquement pour vous</h2>
    </div>

    <div class="notifications-list">
        <?php if ($result->num_rows != 0) { ?>
            <?php while ($notification = mysqli_fetch_assoc($result)): ?>
                <div class="notification-item <?php echo $notification['statut'] === 'Non lue' ? '' : 'read'; ?>"
                    data-notification-id="<?php echo $notification['id_notification']; ?>"
                    onclick="markAsReadAndShowNotification(<?php echo htmlspecialchars(json_encode($notification), ENT_QUOTES, 'UTF-8'); ?>)">
                    <div class="avatar">
                        <img src="images/image (1).jpeg" alt="Avatar">
                        <?php if ($notification['statut'] === 'Non lue'): ?>
                            <div class="notification-point"></div> <!-- Point rouge pour les notifications non lues -->
                        <?php endif; ?>
                    </div>
                    <div class="notification-content">
                        <div class="user-name">Utilisateur ID <?php echo $notification['id_utilisateur']; ?></div>
                        <div class="notification-text"><?php echo $notification['message']; ?></div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php } else {
            echo '<p>Vous n\'avez aucune notification pour le moment.</p>';
        } ?>


    </div>
</div>

<!-- Modal pour afficher la notification -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Le message de la notification sera injecté ici -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script>
    function markAsReadAndShowNotification(notification) {
        var notificationId = notification.id_notification;

        // Utilisation de fetch pour appeler le même fichier PHP et mettre à jour le statut de la notification
        fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_notification=' + notificationId
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour visuellement la notification
                    var notificationItem = document.querySelector('[data-notification-id="' + notificationId + '"]');
                    notificationItem.classList.add('read');
                    // Supprimer le point rouge
                    var point = notificationItem.querySelector('.notification-point');
                    if (point) point.style.display = 'none';
                }
            });

        // Afficher le contenu de la notification dans la modale
        document.querySelector('.modal-body').innerText = notification.message;
        var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
        notificationModal.show();
    }
</script>

<?php
include "../footer.php";
?>
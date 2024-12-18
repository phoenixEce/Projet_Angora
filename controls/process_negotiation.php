<?php
// Désactiver l'affichage des erreurs
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Fonction pour logger les erreurs
function logError($message) {
    error_log(date('[Y-m-d H:i:s] ') . $message . "\n", 3, 'error_log.txt');
}

// Fonction pour envoyer une réponse JSON
function sendJsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}

function sendNotification($connection, $id_utilisateur, $message) {
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

try {
    include '../../db_connection.php';

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!isset($data['action']) || !isset($data['negotiationId'])) {
        throw new Exception('Données manquantes');
    }

    $action = $data['action'];
    $negotiationId = $data['negotiationId'];

    switch ($action) {
        case 'counter-offer':
            if (!isset($data['amount']) || !is_numeric($data['amount'])) {
                throw new Exception('Montant invalide');
            }
            $amount = $data['amount'];
            $query = "UPDATE negotiation SET contre_offre_vendeur = ?, statut_negotiation = 'En cours' WHERE id_negotiation = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("di", $amount, $negotiationId);
            sendNotification($connection, 1, "Nouvelle Contre Offre mise à jour par le vendeur à hauteur de ".$amount."$");

            break;

        case 'refuse':
            $query = "UPDATE negotiation SET statut_negotiation = 'Echouee' WHERE id_negotiation = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $negotiationId);
            sendNotification($connection, 1, "Offre refusée par le vendeur");

            break;

        case 'close':
            $query = "UPDATE negotiation SET statut_negotiation = 'Conclue' WHERE id_negotiation = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("i", $negotiationId);
            sendNotification($connection, 1, "Offre acceptée par le vendeur");

            break;

        default:
            throw new Exception('Action non reconnue');
    }

    if (!$stmt->execute()) {
        throw new Exception('Erreur lors de l\'exécution de la requête: ' . $stmt->error);
    }

    sendJsonResponse(['success' => true, 'message' => 'Opération réussie']);

} catch (Exception $e) {
    logError($e->getMessage());
    sendJsonResponse(['success' => false, 'message' => 'Une erreur est survenue: ' . $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($connection)) {
        $connection->close();
    }
}
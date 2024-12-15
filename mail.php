<?php
// Vérifiez que le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations de la commande
    $userEmail = $_POST['user_email']; // L'email de l'utilisateur
    $orderDetails = $_POST['order_details']; // Détails de la commande (ex: produit, quantité, prix)

    // Paramètres de l'email
    $subject = "Confirmation de commande";
    $message = "Bonjour,\n\nMerci pour votre commande !\n\nVoici les détails de votre commande :\n" . $orderDetails . "\n\nNous vous remercions de votre achat.";
    $headers = "From: mongouebaudry35@gmail.com" . "\r\n" .
               "Reply-To: baudrysamuel.mongoueyamkam@edu.ece.fr" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Envoi de l'email
    if (mail($userEmail, $subject, $message, $headers)) {
        echo "Un email de confirmation a été envoyé à " . $userEmail;
    } else {
        echo "Erreur lors de l'envoi de l'email.";
    }
}
?>

<!-- Formulaire HTML pour passer une commande -->
<form method="POST" action="">
    <label for="user_email">Email de l'utilisateur :</label>
    <input type="email" id="user_email" name="user_email" required><br>

    <label for="order_details">Détails de la commande :</label>
    <textarea id="order_details" name="order_details" required></textarea><br>

    <input type="submit" value="Passer la commande">
</form>

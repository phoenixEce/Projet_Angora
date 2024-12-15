<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_article'])) {
        $id_article = intval($_POST['id_article']);

        if (isset($_POST['remove'])) {
            // Retirer un article du panier
            unset($_SESSION['panier'][$id_article]);
        }

        // Rediriger vers la page du panier
        header('Location: cart.php');
        exit();
    }
}

<?php
// Informations de connexion
$host = 'localhost'; // ou l'adresse de votre serveur de base de données
$username = 'root';
$password = '';
$database = 'Agora';

// Création de la connexion
$connection = new mysqli($host, $username, $password, $database);

// Vérification de la connexion
if ($connection->connect_error) {
    die("Échec de la connexion : " . $connection->connect_error);
}


// N'oubliez pas de fermer la connexion lorsque vous avez terminé
//$connection->close();
?>
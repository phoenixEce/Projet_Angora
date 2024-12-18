<?php
// Informations de connexion
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

// Création de la connexion
$connection = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($connection->connect_error) {
    die("Échec de la connexion : " . $connection->connect_error);
}


// N'oubliez pas de fermer la connexion lorsque vous avez terminé
//$connection->close();
?>
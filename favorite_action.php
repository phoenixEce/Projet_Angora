<?php
session_start();
$host = 'localhost';
$dbname = 'agora';
$username = 'root';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $articleId = $data['articleId'];
    $action = $data['action'];
    $userId = $_SESSION['id_utilisateur'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO favoris (id_utilisateur, id_article) VALUES (:userId, :articleId)");
            $stmt->execute(['userId' => $userId, 'articleId' => $articleId]);
        } elseif ($action === 'remove') {
            $stmt = $pdo->prepare("DELETE FROM favoris WHERE id_utilisateur = :userId AND id_article = :articleId");
            $stmt->execute(['userId' => $userId, 'articleId' => $articleId]);
        }

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

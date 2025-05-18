<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'infiniteroots_users';
$user = 'infiniteroots_mathieu';
$pass = 'teamspirit';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Erreur connexion DB : ' . $e->getMessage());
}

// Récupérer les données du formulaire
$pseudo = $_POST['pseudo'] ?? '';
$type = $_POST['type'] ?? '';
$tone = $_POST['tone'] ?? '';
$message = $_POST['message'] ?? '';
$gif = $_POST['gif'] ?? '';

// Requête d'insertion sans created_at
$stmt = $pdo->prepare("INSERT INTO users (nom, categories, emotion, commentaires, gif, votes)
                       VALUES (:nom, :categories, :emotion, :commentaires, :gif, :votes)");

$stmt->execute([
    ':nom' => $pseudo,
    ':categories' => $type,
    ':emotion' => $tone,
    ':commentaires' => $message,
    ':gif' => $gif,
    ':votes' => 0
]);

// Récupérer l'ID du dernier enregistrement et rediriger
$lastId = $pdo->lastInsertId();
header("Location: preview.php?id=" . $lastId);
exit;
?>

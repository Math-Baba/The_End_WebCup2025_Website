<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
header('Content-Type: application/json');


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'])) {
    echo json_encode(['success' => false, 'message' => 'ID manquant']);
    exit;
}

$id = intval($data['id']);

$sql = "UPDATE users SET votes = votes + 1 WHERE id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur SQL']);
}

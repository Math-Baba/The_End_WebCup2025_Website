<?php
require_once (__DIR__.'/config/mysql.php');

$pseudo = $_POST['pseudo'] ?? null;
$categories = $_POST['categories'] ?? null;
$tone = $_POST['tone'] ?? null;
$commentaires = $_POST['commentaires'] ?? null;

    try {
        $mysqlClient = new PDO(
                sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
                        MYSQL_USER,
                        MYSQL_PASSWORD
                            );

        $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlRequest = "INSERT INTO users (nom, categories, emotion, commentaires) VALUES (:pseudo, :categories, :tone, :commentaires)";
        $pdoStatement = $mysqlClient->prepare($sqlRequest);
        $pdoStatement->execute([
            ':pseudo' => $pseudo,
            ':categories' => $categories,
            ':tone' => $tone,
            ':commentaires' => $commentaires,
        ]);

        $pdoStatement->fetchColumn();

        if($pdoStatement->rowCount() > 0){
            echo ('<script>window.location.href = "avis.php";</script>');
        } 
        
        } catch (Exception $exception) {
        die('Erreur : ' . $exception->getMessage());
        }

?>
<?php

$host = 'localhost';
$dbname = 'e-learning'; 
$username = 'root';         
$password = '';             

// Connexion PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message d'erreur
    echo "Échec de la connexion : " . $e->getMessage();
}
?>

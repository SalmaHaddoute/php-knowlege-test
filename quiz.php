<?php
session_start();

// Connexion à la base de données en utilisant PDO
$dsn = "mysql:host=localhost;dbname=e-learning";
$username = "root";
$password = "";

try {
    $conn = new PDO($dsn, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si l'ID du candidat est défini dans la session
    if (isset($_SESSION['id_candidat'])) {  
        $id_candidat = $_SESSION['id_candidat'];
    } else {
        die("Erreur: Aucun candidat connecté.");
    }

    // Vérifier si un score a été envoyé
    if (isset($_POST['score'])) {
        $score = $_POST['score'];

        // Préparer la requête SQL pour insérer le résultat
        $sql = "INSERT INTO tests (candidat_id, score) VALUES (:candidat_id, :score)";  
        $stmt = $conn->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':candidat_id', $id_candidat, PDO::PARAM_INT);
        $stmt->bindParam(':score', $score, PDO::PARAM_INT);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Afficher une alerte en cas de succès
            echo "<script type='text/javascript'>
                    alert('Enregistrement réussi !');
                  </script>";
        } else {
            echo "Erreur lors de l'enregistrement.";
        }
    } else {
    }
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

$conn = null;
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>quiz</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
        <!-- Menu de navigation -->
        <nav class="navbar">
        <div class="left-menu">
            <a href="index.php" class="elearning">E-learning</a>
        </div>
        <ul class="right-menu">
            <li><a href="quiz.php">Quis PHP</a></li>
            <li class="profil">
            <i class='bx bx-user-circle' style='color:#ffffff'  ></i>
                <a href="#">Profil</a>
                <ul class="dropdown">
                    <li><a href="newAcc.php">Créer un compte</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
        <!-- Ton contenu existant commence ici -->
        <div class="button-container">
        <button id="btn-message">Message</button>
        <button id="btn-questionnaire">Questionnaire</button>
        <button id="btn-resultat">Résultat</button>
    </div>
    
    <div class="container">
        <!-- Section Message -->
        <div id="message-section" class="section active">
            <h2>Message</h2>
            <p id="Message">Bienvenue sur notre site. Cliquez sur le bouton questionnaire pour commencer le test.</p>
        </div>
        <!-- Section Questionnaire -->
        <div id="questionnaire-section" class="section">
            <h2>Questionnaire</h2>
            <div id="progress-container">
                <div id="progress-bar"></div>
            </div>
            <div id="timer-display"></div> <!-- Ajout de l'affichage du timer -->
            <div id="question-container">
                <!-- Les questions seront injectées ici -->
            </div>
            <div id="error-message" style="color: red; display: none;margin-bottom: 10%;"></div>
            <button id="next-btn">Suivant</button>
        </div>
    
        <!-- Section Résultat -->
        <div id="result-section" class="section">
    <h2>Résultat</h2>
    <p id="result-message"></p>
    <form method="POST" action="quiz.php">
        <input type="hidden" name="score" id="final-score" value="">
        <button type="submit" class="bd">Envoyer</button>
        <button type="button" class="bd" onclick="location.reload()">Actualiser</button>
    </form>
</div>

    </div>
    
    <script src="app.js"></script>
</body>
</html>
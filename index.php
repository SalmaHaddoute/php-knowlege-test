
<?php
session_start();

if (!isset($_SESSION['connected']) || $_SESSION['connected'] !== true) {
    header("Location: log.php");
    exit();
}

$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-KNOWLEDGE-TEST</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
    .message-container {
    background-color: #f0f0f0; /* Gris clair */
    padding: 20px;
    border-radius: 8px;
    max-width: 400px;
    margin: 20px auto;
    text-align: center;
}

.salutation-message {
    font-size: 16px;
    color: #333;
    font-size: larger;
    font-family: 'Times New Roman', Times, serif;
    font-style: oblique;
    color:#f48200;
}

.test-button {
    display: inline-block;
    padding: 10px 20px;
    margin-top: 10px;
    color: #fff;
    background-color: #007bff; /* Bleu pour le bouton */
    text-decoration: none;
    border-radius: 5px;
}

.test-button:hover {
    background-color: #0056b3; /* Couleur du bouton au survol */
}
</style>
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

    <div class="message-container">
        <p class="salutation-message">Bonjour <?php echo htmlspecialchars($first_name) . ' ' . htmlspecialchars($last_name); ?>! Si vous souhaitez tester vos connaissances en PHP, cliquez sur le bouton ci-dessous :</p>
        <a href="test_php.html" class="test-button">Qui test ?</a>
    </div>
</body>
</html>




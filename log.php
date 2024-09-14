<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "e-learning";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM condidat WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION['connected'] = true;
            $_SESSION['id_candidat'] = $user['id'];
            $_SESSION['first_name'] = $user['firstname'];
            $_SESSION['last_name'] = $user['lastname'];
            header("Location: index.php");
            exit();
        } else {
            $message = 'Le mot de passe ou l\'email sont incorrects !!';
        }
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        /* Style de la barre de navigation */
        .navbar {
            background-color: black;
            color: white;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            align-items: center;
            width: 98%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* Menu à gauche */
        .left-menu {
            font-weight: bold;
        }

        .left-menu .elearning {
            color: white;
            text-decoration: none;
        }

        /* Menu à droite */
        .right-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        .right-menu li {
            position: relative;
            margin-right: 18%;
        }

        .right-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
        }

        /* Menu déroulant sous "Profil" */
        .right-menu .dropdown {
            display: none;
            position: absolute;
            top: 28px;
            left: 0;
            background-color: white;
            padding: 0;
            list-style-type: none;
            min-width: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .right-menu .dropdown li a {
            color: black;
            padding: 10px;
            display: block;
            text-decoration: none;
        }

        .right-menu .dropdown li a:hover {
            background-color: lightgray;
        }

        /* Affichage du menu déroulant lors du survol */
        .profil:hover .dropdown {
            display: block;
        }

        /* Style général */
        body {
            font-family: Arial, sans-serif;
            background-color: #444141; /* Couleur gris pour le fond */
            color: #fff;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: #fff;
            color: #000;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
            color:orange;
            font-weight: 1600;
            font-style: oblique;

        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #000;
        }

        input {
            width: 90%;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 4px;
        }

        button {
            width: 90%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #444;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }

        .message {
            background-color: pink;
            color: red;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Pour empêcher le contenu de se superposer à la barre de navigation */
        .spacer {
            height: 70px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="left-menu">
            <a href="#" class="elearning">E-learning</a>
        </div>
        <ul class="right-menu">
            <li class="profil">
                <a href="#">Profil</a>
                <ul class="dropdown">
                    <li><a href="newAcc.php">Créer un compte</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Un espace pour empêcher le contenu de se superposer à la navigation fixe -->
    <div class="spacer"></div>

    <div class="login-container">
        <h2>Connexion</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="login@gmail.com" required>
            </div>
            <div class="input-group">
                <label for="password">Mot de Passe</label>
                <input type="password" id="password" name="password" placeholder="your password" required>
            </div>
            <button type="submit">Se Connecter</button>
        </form>
    </div>

</body>
</html>

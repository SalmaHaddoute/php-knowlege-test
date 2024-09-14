<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Compte Candidat</title>
    <?php
    include 'conn.php'; 

    // Initialisation de la variable de message
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstname = htmlspecialchars($_POST['firstname']);
        $lastname = htmlspecialchars($_POST['lastname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $position = htmlspecialchars($_POST['position']);
        $password = htmlspecialchars($_POST['password']);

        // Préparer la requête SQL pour insérer les données
        $sql = "INSERT INTO condidat (firstname, lastname, email, phone, position,password) VALUES (:firstname, :lastname, :email, :phone, :position,:password)";
        
        try {
            // Préparer la requête
            $stmt = $conn->prepare($sql);

            // Lier les paramètres
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':position', $position);
            $stmt->bindParam(':password', $password);

            // Exécuter la requête
            $stmt->execute();
            
            $message = "Compte créé avec succès!";
        } catch (PDOException $e) {
            $message = "Erreur : " . $e->getMessage();
        }
    }
    ?>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #444141;
            color: #fff; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .navbar {
            background-color: black;
            color: white;
            display: flex;
            justify-content: space-between; 
            padding: 10px 20px;
            align-items: center;
            width: 99%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .left-menu .elearning {
            color: white;
            text-decoration: none;
        }

        .right-menu {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        .right-menu li {
            position: relative;
        }

        .right-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 10px;
        }

        .right-menu .dropdown {
            display: none;
            position: absolute;
            top: 30px;
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

        .profil:hover .dropdown {
            display: block;
        }

        .account-container {
            background-color: #fff; 
            color: #000; 
            padding: 20px;
            border-radius: 8px;
            width: 350px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
            font-size: larger;
            color:#007bff;
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
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #444;
        }

        .message {
            background-color: #d4edda; /* Vert pâle */
            color: #155724; /* Vert foncé */
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Menu de navigation -->
    <nav class="navbar">
        <div class="left-menu">
            <a href="#" class="elearning">E-learning</a>
        </div>
        <ul class="right-menu">
            <li><a href="quiz.php">Quis PHP</a></li>
            <li class="profil">
                <a href="#">Profil</a>
                <ul class="dropdown">
                    <li><a href="newAcc.php">Créer un compte</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div class="account-container">
        <h2>Création de Compte Candidat</h2>
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <div class="input-group">
                <label for="firstname">Prénom</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="input-group">
                <label for="lastname">Nom</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="phone">Numéro de Téléphone</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="input-group">
                <label for="position">Poste Souhaité</label>
                <input type="text" id="position" name="position" required>
            </div>
            <div class="input-group">
                <label for="mode de pass">Mode passe</label>
                <input type="text" id="mode de passe" name="password" required>
            </div>
            <button type="submit">Créer un compte</button>
        </form>
    </div>
</body>
</html>

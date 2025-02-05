<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Récupérer l'utilisateur de manière sécurisée
    $stmt = $pdo->prepare("SELECT id, nom, password FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie
        # code...
        echo "Connexion réussie ! <a href='dashboard.php'>Accéder au tableau de bord</a>";
    } else {
        echo "Idenfiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>

<body>
    <h2>Inscription</h2>
    <form method="post">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit" name="login">Se connecter</button>
    </form>
</body>

</html>
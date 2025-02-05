<?php
require 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash du mot de passe

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Cet email est déjà utilisé.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (nom, email, password) VALUES (:nom, :email, :password)");
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Inscription réussie. <a href='login.php'>Se connecter</a>";
        } else {
            echo "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <h2>Inscription</h2>
    <form method="post">
        <label for="nom">Nom Complet :</label>
        <input type="text" name="nom" id="nom" required><br><br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>
        <button type="submit" name="register">S'inscrire</button>
    </form>
</body>

</html>
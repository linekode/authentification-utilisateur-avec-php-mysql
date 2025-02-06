<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        <h2 class="card-title text-center">Bienvenue, <?= htmlspecialchars($_SESSION['user_nom']); ?></h2>
                        <div class="text-center">
                            <a href="logout.php" class="btn btn-danger">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
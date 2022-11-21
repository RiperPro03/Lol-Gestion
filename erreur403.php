<?php
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 403 | LoL Gestion</title>
    <link rel="stylesheet" href="css/erreur.css">
    <link rel="icon" href="img/logo/lol.jpg">
</head>

<body>
    <div class="gandalf">
        <div class="fireball"></div>
        <div class="skirt"></div>
        <div class="sleeves"></div>
        <div class="shoulders">
            <div class="hand left"></div>
            <div class="hand right"></div>
        </div>
        <div class="head">
            <div class="hair"></div>
            <div class="beard"></div>
        </div>
    </div>
    <div class="message">
        <h1>403 - Accès non autorisé !</h1>
        <p>Oh oh, Gandalf bloque le chemin !<br />Veuillez vous connecter <a href="login.php">ici</a></p>
    </div>
</body>

</html>
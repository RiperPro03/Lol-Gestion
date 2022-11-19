<?php
    require 'includes/db.php';
    global $db;
    session_start();
    if (!(isset($_SESSION['user']))) {
        header('Location:login.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion</title>
    <link rel="icon" href="img/logo/lol.jpg">
</head>
<body>
    <h1>Vous êtes connecté en tant que : <?= $_SESSION['user'];?></h1>
    <a href="logout.php">Déconnection</a>
</body>
</html>
<?php
    require 'includes/db.php';
    global $db;
    session_start();
    if ((isset($_SESSION['authToken']))) {
        if ((time() <= $_SESSION['authTokenExpire'])) {
            header('Location:./');
            exit;
        }
    }
    require 'includes/login.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Connexion</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="./img/content/logo.png">
</head>
<body>
    <div class="titre">
        <h1> Lol Gestion</h1>
        <h2><span>Gestion d'équipe esport</span><span>League Of Legends</span></h2>
    </div>
<div class="card">
    
    <div class="box">
        <div class="form">
            <h2>Connexion</h2>
            <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">

                <div class="inputBox">
                    <input type="text" name="luser" required="required" autocomplete="off">
                    <span>Utilisateur</span>
                    <i></i>
                </div>
    
                <div class="inputBox">
                    <input type="password" name="lpass" required="required" autocomplete="off">
                    <span>Mot de passe</span>
                    <i></i>
                </div>
                <input type="submit" value="Connexion" name="formlogin">
            </form>
        </div>
    </div>
    
</body>
</html>
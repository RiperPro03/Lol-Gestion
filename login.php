<?php
    require 'includes/db.php';
    global $db;
    session_start();
    if ((isset($_SESSION['authToken']))) {
        if ((time() <= $_SESSION['authTokenExpire'])) {
            header('Location:index.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Connexion</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>
<body>
<div class="card">
    
    <div class="box">
        <div class="form">
            <h2>Connexion</h2>
            <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">

                <div class="inputBox">
                    <input type="text" name="luser" required="required">
                    <span>Utilisateur</span>
                    <i></i>
                </div>
    
                <div class="inputBox">
                    <input type="password" name="lpass" required="required">
                    <span>Mot de passe</span>
                    <i></i>
                </div>
                <input type="submit" value="Connexion" name="formlogin">
            </form>
            <?php
                require 'includes/login.php';
            ?>
        </div>
    </div>
    
</body>
</html>
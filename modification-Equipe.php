<?php 
    require 'includes/header.php';
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Modification Equipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>
<body>
<div class="container">
        <div class="card">

            <?php require 'includes/modif-Equipe.php';?>

            <a href="javascript:history.back()">Retour</a>
            <h3>Modification d'une équipe</h3>

            <form method="post">

                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">
                
                <div class="inputBox">
                    <input type="text" name="nom" required="required" autocomplete="off" value=<?= $equipe['nom'] ?>>
                    <span>Nom d'équipe</span>
                </div>

                <input type="submit" name="formsend" value="Envoyer" class="button">
            </form>
        </div>
    </div>
</body>
</html>
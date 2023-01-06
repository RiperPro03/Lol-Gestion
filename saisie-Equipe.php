<?php
    require 'includes/header.php';
    require 'includes/ajout-Equipe.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Saisie equipe match</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>
<body>
<div class="container">
        <div class="card">

            
            <h3>Saisie d'une équipe</h3>

            <form action="./selectionJoueur.php" method="get">
                
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

                <div class="inputBox">
                    <input type="text" max= 50 name="nomEquipe" required="required" autocomplete="off">
                    <span>Nom d'équipe</span>
                </div>
                <a href="javascript:history.back()">Retour</a>
                <input type="submit" name="formsend" value="Ajouter" class="button">
            </form>
        </div>
    </div>
    
</body>
</html>
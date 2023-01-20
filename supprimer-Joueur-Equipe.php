<?php
    require 'includes/header.php';

    require 'includes/supp-Joueur-Equipe.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Supprimer Joueur d'une équipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="./img/content/logo.png">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer le Joueur de l'équipe ?</p>
            <p>Nom : <?= $joueur['nom'] ?></p>
            <p>Prenom : <?= $joueur['prenom'] ?></p>
            <p><?= "<img src='./img/players/".$joueur['photo']."' width='80px' >"?></p>
            <form method="post">
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">
                <div class="option">
                    <input type="submit" name="reponse" value="Annuler" class="button">
                    <input type="submit" name="reponse" value="Oui" class="button">
                </div> 
            </form>
        </div>
    </div>

</body>

</html>
<?php
    require 'includes/header.inc';

    require 'includes/supp-Joueur.inc';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Supprimer Joueur</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=lol.jpg">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer le Joueur : </p>
            <p>Nom : <?= $joueur['nom'] ?></p>
            <p>Prenom : <?= $joueur['prenom'] ?></p>
            <p><?= "<img src='vue-img.php?img=".$joueur['photo']."' width='80px' >"?></p>
            <form method="post">
                <p>
                    <input type="submit" name="reponse" value="Oui" class="button">
                    <input type="submit" name="reponse" value="Annuler" class="button">
                </p>
            </form>
        </div>
    </div>

</body>

</html>
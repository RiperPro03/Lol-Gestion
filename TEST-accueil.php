<?php
require 'includes/Carte-Joueur.php';
require 'includes/Carte-Equipe.php';
require 'includes/Carte-Match.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./css/TEST-accueil.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-carteJoueur.css">
    <link rel="stylesheet" href="./css/TEST-carteEquipe.css">
    <link rel="stylesheet" href="./css/TEST-carteMatch.css">
    
</head>

<body>

    <?php
        require 'includes/nav-bar.html';
    ?>

    <div class="corps">
        <div class="listeJoueurs">
            <h1>Joueurs</h1>
            <?php $joueur = new CarteJoueur('Sang-hyeok', 'Lee', 'Faker', 'Mid', '637a7214430be5.13956557.png', 10, 10);
            echo $joueur->get_carteJoueurAccueil();
            $joueur = new CarteJoueur('Heo', 'Su', 'ShowMaker', 'Mid', '637a95e14c6109.56237078.png', 5, 12);
            echo $joueur->get_carteJoueurAccueil();
            echo $joueur->get_carteJoueurAccueil();
            echo $joueur->get_carteJoueurAccueil();
            echo $joueur->get_carteJoueurAccueil();
            echo $joueur->get_carteJoueurAccueil();
            ?>
        </div>
        <div class="historique">
            <h1>Anciens matchs</h1>
            <?php
                $equipe1 = new CarteEquipe('T1','SKT T1'); 
                $equipe2 = new CarteEquipe('C9','Cloud 9'); 
                $match =new CarteMatch('12/02/2021','15h30',$equipe1,$equipe2,'3 : 1');
                echo $match->get_carteMatch();
                $match =new CarteMatch('13/02/2022','14h',$equipe2,$equipe1,null);
                echo $match->get_carteMatch();
            ?>
        </div>
    </div>
</body>

</html>
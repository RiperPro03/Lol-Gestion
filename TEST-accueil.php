<?php
require 'includes/Carte-Joueur.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="css/TEST-accueil.css">
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
            <div><a href=""></a>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam rerum accusamus ea pariatur, mollitia laboriosam explicabo? Nesciunt quos incidunt corporis optio nemo odio, id exercitationem aperiam vero sit voluptatibus perspiciatis.</p>
            </div>
        </div>
    </div>
</body>

</html>
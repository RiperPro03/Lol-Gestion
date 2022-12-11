<?php
    require 'includes/Carte-Joueur.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/accueil-TEST.css">
</head>
<body>
    <header>
        <nav>
            <ul>
               <li> <a href="">Joueurs</a></li>
            </ul>
            <ul>
                <li> <a href="">Planning</a></li>
            </ul>
            <ul>    
                <li> <a href="">Creation d'une équipe</a></li>
            </ul>
            <ul>
                <li> <a href="">Historique match</a></li>
            </ul>
        </nav>
    </header>
    <div class="corps">
        <div class="listeJoueurs">
            <?php $joueur = new CarteJoueur('Sang-hyeok','Lee','Faker','Mid','637a7214430be5.13956557.png'); 
            echo $joueur->get_carteJoueur();
            ?>
        </div>
        <div class="historique">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam rerum accusamus ea pariatur, mollitia laboriosam explicabo? Nesciunt quos incidunt corporis optio nemo odio, id exercitationem aperiam vero sit voluptatibus perspiciatis.</p>
        </div>
    </div>
</body>
</html>
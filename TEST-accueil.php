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
    
<!--debut de la barre de navigation -->
    <nav class="navigation">
        <div class="menuDeroulant"></div>
        <ul>
            <li class="liste active">
                <a href="#" style="--clr:#f44336;">
                <span class="icone"> <div><img src="vue-img.php?img=logo.png" style="width:100%;"></div></span>
                <span class="texte"> Accueil</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#eec601;">
                <span class="icone"><div><img src="vue-img.php?img=Joueur.png" style="width:100%;"></div> </span>
                <span class="texte"> Joueur</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#01ee05;">
                <span class="icone"><div><img src="vue-img.php?img=Planning.png" style="width:100%;"></div> </span>
                <span class="texte"> Planning</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#01eeea;">
                <span class="icone"><div><img src="vue-img.php?img=Team.png" style="width:100%;"> </div></span>
                <span class="texte"> Creer une équipe</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#0128ee;">
                <span class="icone"><div><img src="vue-img.php?img=Historique.png" style="width:100%;"></div> </span>
                <span class="texte"> Historique des matchs</span>
                </a>
            </li>
        </ul>
    </nav>
    <script>
        let menuDeroulant = document.querySelector('.menuDeroulant');
        let navigation = document.querySelector('.navigation');
        menuDeroulant.onclick =function(){
            navigation.classList.toggle('active');
        }

        let list = document.querySelectorAll('.liste');
        function activeLink(){
            list.forEach((item) => item.classList.remove('active'));
            this.classList.add('active');
        }
        list.forEach((item) => item.addEventListener('click',activeLink));
    </script>
    <!--fin de la barre de navigation -->

    <div class="corps">
        <div class="listeJoueurs">
            <h1>Joueurs</h1>
            <?php $joueur = new CarteJoueur('Sang-hyeok','Lee','Faker','Mid','637a7214430be5.13956557.png'); 
            echo $joueur->get_carteJoueur();
            $joueur = new CarteJoueur('Heo', 'Su','ShowMaker','Mid','637a95e14c6109.56237078.png');
            echo $joueur->get_carteJoueur();
            ?>
        </div>
        <div class="historique">
            <h1>Anciens matchs</h1>
            <div>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam rerum accusamus ea pariatur, mollitia laboriosam explicabo? Nesciunt quos incidunt corporis optio nemo odio, id exercitationem aperiam vero sit voluptatibus perspiciatis.</p>
        </div>
        </div>
    </div>
</body>
</html>
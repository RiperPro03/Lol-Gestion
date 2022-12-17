<?php
    require 'includes/Carte-Equipe.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>TEST-CarteMatch</title>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/detailsMatch.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="lienEntreTest">
            <a href="./TEST-DetailsJoueur.php"> test details Joueur</a>
            <a href="./TEST-DetailsEquipe.php">test details equipe</a>
        </div>
        <div class="boiteDetailsMatch">
            <div class="contourDetails">
            </div>
            <div class="boiteTexte">
                <div class="titre">
                    <h2>Details Match</h2>
                </div>
                <div class="detailsInfoMatch">
                    <p>
                        Date du match :<span> 12/02/2021</span>
                    </p>
                    <p>
                        Heure du match : <span> 15h</span>
                    </p>
                    <p>
                        Lieu du match : <span> Toulouse Rangueil</span>
                    </p>
                    <p>
                        Description du match :</br> <span>Match sérree entre les 2 equipes</span>
                    </p>
                    <p> Equipe : </p>
                    <div class="equipesMatch">
                        <?php
                            $equipe = new CarteEquipe('SK Telecom T1');
                            $equipe2 = $equipe;
                            echo $equipe->get_carteEquipeAccueil();
                            echo '<div class="Versus">
                            <img src="vue-img.php?img=Versus.png" style="width:100%;">
                                </div>';
                            echo $equipe2->get_carteEquipeAccueil();
                        ?>
                    </div>
                    <p> Gagnant : <span> T1</span></p>
                    <p> Score : <span> 3 : 0</span></p>
                </div>
            </div>
            <div class="optionDetails">
                <a href="#1" class="boutonDetail"><i class="fa-solid fa-pen"></i></a>
                <a href="#2" class="boutonDetail"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
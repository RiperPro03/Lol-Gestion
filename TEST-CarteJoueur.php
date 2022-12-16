<?php
    require 'includes/Carte-Joueur.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST-CarteEquipe</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-carteJoueur.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="lienEntreTest">
            <a href="./TEST-CarteEquipe.php"> test carte Equipe</a>
            <a href="./TEST-CarteMatch.php">test carte Match</a>
        </div>
        
        <?php
            $image = '637a7214430be5.13956557.png';
            $joueur = new CarteJoueur('su','lee','Lebon','Bot',$image,'12','15');
            echo $joueur->get_carteJoueurAccueil(); 
        ?>
       
       <div class="carteJoueur">
            <div class="contourJoueur">
            </div>
            <div class="boiteimageJoueur">
                <div class="imageJoueur">
                    <img src="vue-img.php?img=637a7214430be5.13956557.png"style="width:100%;"> 
                </div>
            </div>
            <div class="boiteInfoJoueur">
                <div class="detailsJoueur">
                    <h2> faker <br><span>lee see Hyuang </span></h2>
                    <div class="infoJoueur">
                        <h3> Poste<br> <span>mid</span></h3>
                        <h3> Victoire<br><span>11</span></h3>                        
                        <h3> Selection<br><span>15</span>
                    </div>
                    <div class="option">
                        <a href="#" class="bouton"><i class="fa-solid fa-pen"></i></a>
                        <a href="#2" class="bouton"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>
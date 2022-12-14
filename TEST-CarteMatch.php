<?php
    require 'includes/Carte-Equipe.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-carteEquipe.css">
    <link rel="stylesheet" href="./css/TEST-carteMatch.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
            <div class="carteMatch">
                <div class="Equipe">
                    <?php
                        $equipe = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe->get_carteEquipe(); 
                    ?>
                    <div class=" Versus">
                        <img src="vue-img.php?img=Versus.png" style="width:100%;">
                    </div>
                    <?php
                        $equipe = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe->get_carteEquipe(); 
                    ?>
                </div>
                <div class="contourMatch">
                </div>
                <div class="boiteInfoMatch">
                    <div class="detailsMatch">
                        <h2>Match<br><span> 18/02/2020</span></h2>
                        <h2>Score<br><span> 3 : 1</span></h2>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>
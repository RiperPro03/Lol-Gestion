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
    </div>
</body>
</html>
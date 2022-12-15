<?php
    require 'includes/Carte-Equipe.php';
    require 'includes/ajout-Match.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-carteMatch.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
    <link rel="stylesheet" href="./css/carteMatch.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
                    <?php
                        $equipe = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe->get_carteEquipe(); 
                        $equipe2 = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe2->get_carteEquipe();
                        $match = new CarteMatch('12/02/2022','15h',$equipe,$equipe2,'3 : 1');
                        echo $match->get_carteMatch();
                    ?>
    </div>
</body>
</html>
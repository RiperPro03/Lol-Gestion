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
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <?php
            $joueur = new CarteEquipe('SK Telecom T1','T1');
            echo $joueur->get_carteEquipe(); 
        ?>
    </div>
</body>
</html>
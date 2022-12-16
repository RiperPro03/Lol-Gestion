<?php
    require './includes/db.php';
    require 'includes/Carte-Joueur.php';
    
    global $db;
    ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST-joueurs</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-joueur.css">
</head>

<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps"> 
        <h1>Joueurs</h1>
        <div class="zoneRecherche">
            <div class="BarreRecherche">
                <input type="text" placeholder="Rechercher...">
                <div class="recherche"></div>
            </div>
        </div>
        <div class="Joueurs">
        <?php 
                $q = $db->prepare('SELECT nom, prenom, pseudo, poste, photo FROM joueurs');
                $q->execute();

                if ($q->rowCount() > 0) {
                    while ($joueur = $q->fetch()) {
                        $joueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'],0,0);
                        echo $joueur->get_carteJoueurAccueil();
                    }
                } else {
                    echo '<p>Aucun Joueur trouvé</p>';
                }
            ?>
        </div>
    </div>
</body>

</html>
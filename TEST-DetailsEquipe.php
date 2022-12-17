<?php
    require 'includes/Carte-Joueur.php'
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>TEST-DetailsEquipe</title>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-detailsEquipe.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="lienEntreTest">
            <a href="./TEST-DetailsJoueur.php"> test details Joueur</a>
            <a href="./TEST-DetailsMatch.php">test details Match</a>
        </div>
        <div class="boiteDetailsEquipe">
            <div class="contourDetails">
            </div>
            <div class="boiteTexte">
                <div class="titre">
                    <h2>Details Equipe</h2>
                </div>
                <div class="detailsInfoEquipe">
                    <p>
                        Nom :<span> SKT T1</span>
                    </p>
                    
                    <p> Equipe :</p>
                        <?php
                            $image = '637a7214430be5.13956557.png';
                            $joueur = new CarteJoueur('su','lee','Lebon','Bot',$image,'12','15'); 
                        ?>
                    <p><br><span>Top: </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    <p><br><span>Middle: </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    <p><br><span>Jungle: </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    <p><br><span>Bottom: </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    <p><br><span>Support: </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    
                    <p> Remplacant:</p>  
                    <p><br><span><?=$joueur->get_poste()?> </span></p><?=$joueur->get_carteJoueurDetail();?> 
                    <p><br><span><?=$joueur->get_poste()?> </span></p><?=$joueur->get_carteJoueurDetail();?> 
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>TEST-DetailsJoueur</title>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-detailsJoueur.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="lienEntreTest">
            <a href="./TEST-DetailsEquipe.php"> test details Equipe</a>
            <a href="./TEST-DetailsMatch.php">test details Match</a>
        </div>
        <div class="boiteDetailsJoueur">
            <div class="contourDetails">
            </div>
            <div class="boiteTexte">
                <div class="titre">
                    <h2>Details Joueur</h2>
                </div>
                <div class="detailsInfoJoueur">
                    <div class="contourImage">
                        <div class="imageJoueur"><img src="vue-img.php?img=637a7214430be5.13956557.png "style="width:100%;"></div>
                    </div>
                    <p>
                        Pseudo :<span> Faker</span>
                    </p>
                    <p>
                        nom : <span> Syuang</span>
                    </p>
                    <p>
                        Prenom : <span> Lee</span>
                    </p>
                    <p> Date de naissance : <span>12/05/2003</span></p>
                    <p>Taille : <span> 180 cm</span></p>
                    <p>Poids : <span>80 Kg</span></p>
                    <p>Statut :<span>Actif</span></p>
                    <p>Commentaire Joueur :</br> <span> manque de teamplay</span></p>
                    <p><span></span></p>
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
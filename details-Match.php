<?php
    require 'includes/Carte-Equipe.php';
    require 'includes/header.php';
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM matchs WHERE id_Match = :id_Match");
        $q->execute([
            'id_Match' => $id
        ]);
        $nbc = $q->rowCount();

        if($nbc == 1) {
            $match = $q->fetch();
        } else {
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>LoL Gestion | Détails Match</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/detailsMatch.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="boutonRetour">
            <div class="retour">
                <a href="javascript:history.back()" >
                    <img src="vue-img.php?img=turn-left.png" style="width: 100%;">
                </a>
            </div>
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
                        Date du match :<span> <?= date('d/m/Y', strtotime($match['date_match']))?></span>
                    </p>
                    <p>
                        Heure du match : <span> <?= date('H:i', strtotime($match['heure_match']))?></span>
                    </p>
                    <p>
                        Lieu du match : <span> <?= $match['lieu']?></span>
                    </p>
                    <p>
                        Description du match :</br> <span><?= $match['description_match']?></span>
                    </p>
                    <p> Gagnant : <span> <?= $match['gagnant']?></span></p>
                    <p> Score : <span> <?= $match['score']?></span></p>
                    <p> Equipe : </p>
                    <div class="equipesMatch">
                        <?php
                            $equipe = new CarteEquipe("Mon Equipe");
                            $equipe2 = new CarteEquipe($match['equipe_adverse']);
                            $equipe->setIdMatch($match['id_Match']);
                            if ($match['gagnant'] == "My Team") {
                                $equipe->isGagnant(1);
                            } else if ($match['gagnant'] == $match['equipe_adverse']) {
                                $equipe2->isGagnant(1);
                            }
                            echo $equipe->get_carteEquipeAccueil();
                            echo '<div class="Versus">
                                <img src="vue-img.php?img=Versus.png" style="width:100%;">
                                </div>';
                            echo $equipe2->get_carteEquipeAccueilNonClickable();
                        ?>
                    </div>
                    
                </div>
            </div>
            <div class="optionDetails">
                <a href="modification-Match?id=<?= $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-pen"></i></a>
                <a href="./details-Equipe.php?id=<?= $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-people-group"></i></a>
                <a href="./TEST-saisieApresMatch.php?=<? $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-star"></i></a>
                <a href="suppression-Match?id=<?= $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
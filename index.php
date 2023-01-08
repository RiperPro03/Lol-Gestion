<?php
    require './includes/db.php';
    global $db;
    session_start();
    if (!empty($_SESSION['authToken'])) {
        if (time() > $_SESSION['authTokenExpire']) {
            echo '<script>
                alert("Votre session a expiré, veuillez vous reconnecter");
                location.assign("./login");
            </script>';
            exit;
        }
    } else {
        echo '<script>
                location.assign("./login");
            </script>';
        exit;
    }
    require 'includes/Carte-Joueur.php';
    require 'includes/Carte-Equipe.php';
    require 'includes/Carte-Match.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Accueil</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
    <link rel="stylesheet" href="./css/carteMatch.css">
    
</head>

<body>

    <?php
        require 'includes/nav-bar.html';
    ?>

    <div class="corps">
        <div class="listeJoueurs">
            <h1>TOP 5 | Joueurs</h1>
            <?php 
                $q = $db->prepare('SELECT id_Joueur, nom, prenom, pseudo, poste, photo FROM joueurs LIMIT 5');
                $q->execute();

                if ($q->rowCount() > 0) {
                    while ($joueur = $q->fetch()) {
                        $c = $db->prepare('SELECT count(id_Joueur) as nbSelec FROM participe where id_Joueur = :id_Joueur group by id_Joueur');
                        $c->execute(['id_Joueur' => $joueur['id_Joueur']]);
                        if ($c->rowCount() > 0) {
                            $StatSelc = $c->fetch();
                        }else{
                            $StatSelc['nbSelec'] = 0;
                        }
                        $carteJoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'],0,$StatSelc['nbSelec']);
                        $carteJoueur->setIdJoueur($joueur['id_Joueur']);
                        echo $carteJoueur->get_carteJoueurAccueil();
                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Match trouvé</p></div>';
                }
            ?>
        </div>
        <div class="historique">
            <h1>Matchs récents</h1>
            <?php
                $q = $db->prepare('SELECT id_Match, date_match, heure_match, equipe_adverse, score FROM matchs m LIMIT 5');
                $q->execute();

                if ($q->rowCount() > 0) {
                    while ($match = $q->fetch()) {
                        $equipe1 = new CarteEquipe("Mon équipe");
                        $equipe2 = new CarteEquipe($match['equipe_adverse']);
                        $carteMatch = new CarteMatch($match['date_match'],$match['heure_match'],$equipe1,$equipe2,$match['score']);
                        $carteMatch->setIdMatch($match['id_Match']);
                        echo $carteMatch->get_carteMatchAccueil();

                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Match trouvé</p></div>';
                }
            ?>
        </div>
    </div>
</body>

</html>
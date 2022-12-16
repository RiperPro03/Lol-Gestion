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
                $q = $db->prepare('SELECT nom, prenom, pseudo, poste, photo FROM joueurs LIMIT 5');
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
        <div class="historique">
            <h1>Matchs récents</h1>
            <?php
                $equipe1 = new CarteEquipe('SKT T1'); 
                $equipe2 = new CarteEquipe('Cloud 9'); 
                $match =new CarteMatch('12/02/2021','15h30',$equipe1,$equipe2,'3 : 1');
                echo $match->get_carteMatch();
                $match =new CarteMatch('13/02/2022','14h',$equipe2,$equipe1,null);
                echo $match->get_carteMatch();
            ?>
        </div>
    </div>
</body>

</html>
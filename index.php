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
    <link rel="icon" href="./img/content/logo.png">
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
            <h1>Top | Joueurs</h1>
            <?php
                
                $q = $db->prepare('SELECT j.id_Joueur, nom, prenom, pseudo, poste, photo, ROUND(SUM(CASE WHEN gagnant = "My Team" THEN 1 ELSE 0 END) / COUNT(Participe.id_Joueur) * 100, 2) AS nb_victoire
                                    FROM Joueurs j
                                    JOIN Participe ON j.id_Joueur = Participe.id_Joueur 
                                    JOIN Matchs ON Participe.id_Match = Matchs.id_Match 
                                    GROUP BY j.id_Joueur
                                    ORDER BY nb_victoire DESC');
                $q->execute();

                if ($q->rowCount() > 0) {
                    while ($joueur = $q->fetch()) {
                        $c = $db->prepare('SELECT COUNT(p.id_Joueur) AS nb_Selection,
                                            ROUND(SUM(CASE WHEN m.gagnant = "My Team" THEN 1 ELSE 0 END) / COUNT(p.id_Joueur) * 100, 2) AS nb_victoire
                                            FROM participe p, matchs m
                                            WHERE p.id_Match = m.id_Match
                                            AND p.id_Joueur = :id_Joueur');
                        $c->execute([
                            'id_Joueur' => $joueur['id_Joueur']
                        ]);
                        $Stat = $c->fetch();
                        if ($Stat['nb_victoire'] == null) {
                            $Stat['nb_victoire'] = 0;
                        }
                        if ($Stat['nb_Selection'] == null) {
                            $Stat['nb_Selection'] = 0;
                        }
                        $carteJoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'],$Stat['nb_victoire'],$Stat['nb_Selection']);
                        $carteJoueur->setIdJoueur($joueur['id_Joueur']);
                        echo $carteJoueur->get_carteJoueurAccueil();
                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                }
            ?>
        </div>
        <div class="historique">
            <h1>Matchs récents</h1>
            <?php
                $q = $db->prepare('SELECT id_Match, date_match, heure_match, equipe_adverse, score, gagnant 
                                    FROM matchs m
                                    ORDER BY date_match DESC, heure_match DESC 
                                    LIMIT 5');
                $q->execute();

                if ($q->rowCount() > 0) {
                    while ($match = $q->fetch()) {
                        $equipe1 = new CarteEquipe("My Team");
                        $equipe2 = new CarteEquipe($match['equipe_adverse']);
                        if ($match['gagnant'] == "My Team") {
                            $equipe1->isGagnant(1);
                        } else if ($match['gagnant'] == $match['equipe_adverse']) {
                            $equipe2->isGagnant(1);
                        }
                        $equipe1 = $equipe1->get_carteEquipeAccueil();
                        $equipe2 = $equipe2->get_carteEquipeAccueil();
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
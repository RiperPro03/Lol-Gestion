<?php
    require 'includes/header.php';
    require 'includes/Carte-Match.php';
    require 'includes/Carte-Equipe.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Match</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/match.css">
    <link rel="stylesheet" href="./css/carteMatch.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
</head>

<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <h1>Matchs</h1>

        <div class="zoneRecherche">
            <form method="post">
                <div class="BarreRecherche">
                    <input type="search" name="search" placeholder="Rechercher un Match">
                    <div class="recherche"></div>
                </div>
                <div class="reload"><a href="./Match"><i class="fa-solid fa-rotate-right"></i></a></div>
                <div class="ajout"><a href="./saisie-Equipe.php"><i class="fa-solid fa-user-plus"></i></a></div>
            </form>
            
        </div>

        <div class="listeMatch">
            <?php
            //il manque le score du match
                if (isset($_POST['search'])) {
                    if (empty($_POST['search'])) {
                        $q = $db->prepare('SELECT m.id_Match, m.date_match, m.heure_match, m.equipe_adverse,m.score, e.nom FROM matchs m, dispute d, equipes e WHERE m.id_Match = d.id_Match and d.id_Equipe = e.id_Equipe');
                        $q->execute();
                    } else {
                        //probleme sur cette requete
                        $recherche = htmlspecialchars($_POST['search']);
                        $q = $db->prepare('SELECT m.id_Match, m.date_match, m.heure_match, m.equipe_adverse,m.score, e.nom FROM matchs m, dispute d, equipes e 
                                            WHERE m.id_Match = d.id_Match 
                                            and d.id_Equipe = e.id_Equipe
                                            OR e.nom LIKE "%' . $recherche . '%" 
                                            OR m.date_match LIKE "%' . $recherche . '%" 
                                            OR m.heure_match LIKE "%' . $recherche . '%"
                                            OR m.equipe_adverse LIKE "%' . $recherche . '%" 
                                            OR e.nom LIKE "%' . $recherche . '%"');
                        $q->execute();
                    }
                } else {
                    $q = $db->prepare('SELECT m.id_Match, m.date_match, m.heure_match, m.equipe_adverse,m.score, e.nom FROM matchs m, dispute d, equipes e WHERE m.id_Match = d.id_Match and d.id_Equipe = e.id_Equipe');
                    $q->execute();
                }

                if ($q->rowCount() > 0) {
                    while ($match = $q->fetch()) {
                        $equipe1 = new CarteEquipe($match['nom']);
                        $equipe2 = new CarteEquipe($match['equipe_adverse']);
                        $carteMatch = new CarteMatch($match['date_match'],$match['heure_match'],$equipe1,$equipe2,$match['score']);
                        $carteMatch->setIdMatch($match['id_Match']);
                        echo $carteMatch->get_carteMatch();

                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Match trouvé</p></div>';
                }
            ?>
        </div>
    </div>
</body>

</html>
<?php
require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Statistique</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-Statistique.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>

<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <h2 class="titre">Statistique</h2>
        <div class="boiteDetailsStat">
            <div class="contourStat">
            </div>
            <div class="boiteTexte">

                <div class="boiteStatGeneral">
                    <div class="statGeneral">
                        <?php
                            $q = $db->prepare('SELECT COUNT(id_Match) AS nb_match,
                                                SUM(CASE WHEN gagnant = "Mon équipe" THEN 1 ELSE 0 END) AS nb_victoire,
                                                COUNT(id_Match) - SUM(CASE WHEN gagnant = "Mon équipe" THEN 1 ELSE 0 END) AS nb_defaite
                                                FROM matchs');
                            $q->execute();
                            $StatMatch = $q->fetch();
                            if ($StatMatch['nb_victoire'] == 0) {
                                $StatMatch['nb_victoire'] = 0;
                            }
                            if ($StatMatch['nb_defaite'] == 0) {
                                $StatMatch['nb_defaite'] = 0;
                            }
                        ?>

                        <h2> Statistique Globale</h2>
                        <p> Nombre de match: <span> <?= $StatMatch['nb_match'] ?> </span></p>
                        <p> Nombre de victoire: <span> <?= $StatMatch['nb_victoire'] ?></span></p>
                        <p> Nombre de defaite: <span> <?= $StatMatch['nb_defaite'] ?></span></p>
                    </div>
                </div>
                <div class="boiteStatParJoueur">
                    <h2 class="titreStatJ">Statistique par joueur</h2>

                    <form method="get">
                        <input type="search" name="search" placeholder="Rechercher un Joueur" autocomplete="off">
                        <input type="submit" value="Rechercher">
                        <a href="./Statistique"><i class="fa-solid fa-rotate-right"></i></a>
                    </form>
                    

                    <div class="tableauStatJ" id="tableauStatJ">
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Photo</th>
                                <th>Pseudo</th>
                                <th>Poste</th>
                                <th>Statut</th>
                                <th>Nombre de selection</th>
                                <th>Selection titulaire</th>
                                <th>Selection Remplacant</th>
                                <th>Ratio de victoire</th>
                                <th>Moyenne Note</th>
                            </tr>
                            <?php
                                if (isset($_GET['search'])) {
                                    if (empty($_GET['search'])) {
                                        $q = $db->prepare('SELECT id_Joueur, nom, prenom, photo, pseudo, poste, statut FROM joueurs');
                                        $q->execute();
                                    } else {
                                        $recherche = htmlspecialchars($_GET['search']);
                                        $q = $db->prepare('SELECT id_Joueur, nom, prenom, photo, pseudo, poste, statut FROM joueurs 
                                                            WHERE nom LIKE "%' . $recherche . '%" 
                                                            OR prenom LIKE "%' . $recherche . '%" 
                                                            OR pseudo LIKE "%' . $recherche . '%"
                                                            OR poste LIKE "%' . $recherche . '%"
                                                            OR statut LIKE "%' . $recherche . '%"');
                                        $q->execute();
                                    }


                                if ($q->rowCount() > 0) {
                                    while ($joueur = $q->fetch()) {

                                        $c = $db->prepare('SELECT p.id_Joueur, 
                                                                COUNT(p.id_Joueur) AS nb_Selection,
                                                                SUM(p.titulaire) AS nb_Titulaire,
                                                                SUM(CASE WHEN p.titulaire = 0 THEN 1 ELSE 0 END) AS nb_Remplacant,
                                                                AVG(p.evaluation) AS moyenne_Note,
                                                                ROUND(SUM(CASE WHEN m.gagnant = "Mon équipe" THEN 1 ELSE 0 END) / COUNT(p.id_Joueur) * 100, 2) AS nb_victoire
                                                                FROM participe p, matchs m
                                                                WHERE p.id_Match = m.id_Match
                                                                AND p.id_Joueur = :id_Joueur');
                                        $c->execute(array(
                                            'id_Joueur' => $joueur['id_Joueur']
                                        ));
                                        $Stat = $c->fetch();
                                        if ($Stat['nb_victoire'] == 0) {
                                            $Stat['nb_victoire'] = 0;
                                        }
                                        if ($Stat['moyenne_Note'] == 0) {
                                            $Stat['moyenne_Note'] = 0;
                                        }
                                ?>
                                        <tr>
                                            <td><?= $joueur['nom'] ?></td>
                                            <td><?= $joueur['prenom'] ?></td>
                                            <td><?= "<img src='vue-img.php?img=" . $joueur['photo'] . "' width='100px' >" ?></td>
                                            <td><a href="./details-Joueur?id=<?= $joueur['id_Joueur'] ?>"><?= $joueur['pseudo'] ?></a></td>
                                            <td><?= $joueur['poste'] ?></td>
                                            <td><?= $joueur['statut'] ?></td>
                                            <td><?= $Stat['nb_Selection'] ?></td>
                                            <td><?= $Stat['nb_Titulaire'] ?></td>
                                            <td><?= $Stat['nb_Remplacant'] ?></td>
                                            <td><?= $Stat['nb_victoire'] ?>%</td>
                                            <td><?= $Stat['moyenne_Note'] ?>/5</td>
                                        </tr>

                            <?php
                                    }
                                } else {
                                    echo "Aucun utilisateur trouvé";
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
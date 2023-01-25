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
    <link rel="icon" href="./img/content/logo.png">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/statistique.css">
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
                    <h2> Statistique Globale</h2>
                    <div class="statGeneral">
                        <?php
                        $q = $db->prepare('SELECT COUNT(id_Match) AS nb_match,
                                                SUM(CASE WHEN gagnant = "My Team" THEN 1 ELSE 0 END) AS nb_victoire,
                                                COUNT(id_Match) - SUM(CASE WHEN gagnant = "My Team" THEN 1 ELSE 0 END) AS nb_defaite
                                                FROM matchs');
                        $q->execute();
                        $StatMatch = $q->fetch();
                        if ($StatMatch['nb_victoire'] == 0) {
                            $nb_victoire = 0;
                        } else {
                            $nb_victoire = round($StatMatch['nb_victoire'] / $StatMatch['nb_match'] * 100, 2);
                        }
                        if ($StatMatch['nb_defaite'] == 0) {
                            $nb_defaite = 0;
                        } else {
                            $nb_defaite = round($StatMatch['nb_defaite'] / $StatMatch['nb_match'] * 100, 2);
                        }
                        ?>

                        
                        <div class="nombreStat">
                            <p> Nombre de match: <span> <?= $StatMatch['nb_match'] ?> </span></p>
                            <p> Nombre de victoire: <span> <?= $StatMatch['nb_victoire'] ?></span></p>
                            <p> Nombre de defaite: <span> <?= $StatMatch['nb_defaite'] ?></span></p>
                        </div>
                        <div class="pourcentStat">
                            <div class="textStat" style="width: 100%;">
                                <p> Ratio de victoire: <span id="nb_victoire"> <?= $nb_victoire ?></span>%</p>
                                <p> Ratio de defaite: <span id="nb_defaite"> <?= $nb_defaite ?></span>%</p>
                           </div>
                            <div style="width: 50%;">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
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
                        <table id="sortTable">
                            <tr>
                                <th onclick="sortTable(0)">Nom</th>
                                <th onclick="sortTable(1)">Prenom</th>
                                <th onclick="sortTable(2)">Photo</th>
                                <th onclick="sortTable(3)">Pseudo</th>
                                <th onclick="sortTable(4)">Poste</th>
                                <th onclick="sortTable(5)">Statut</th>
                                <th onclick="sortTable(6)">Nombre de selection</th>
                                <th onclick="sortTable(7)">Selection titulaire</th>
                                <th onclick="sortTable(8)">Selection Remplacant</th>
                                <th onclick="sortTable(9)">Ratio de victoire</th>
                                <th onclick="sortTable(10)">Moyenne Note</th>
                            </tr>
                            <?php
                            if (isset($_GET['search'])) {
                                if (!empty($_GET['search'])) {
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
                            } else {
                                $q = $db->prepare('SELECT id_Joueur, nom, prenom, photo, pseudo, poste, statut FROM joueurs');
                                $q->execute();
                            }


                            if ($q->rowCount() > 0) {
                                while ($joueur = $q->fetch()) {

                                    $c = $db->prepare('SELECT COUNT(p.id_Joueur) AS nb_Selection,
                                                                SUM(p.titulaire) AS nb_Titulaire,
                                                                SUM(CASE WHEN p.titulaire = 0 THEN 1 ELSE 0 END) AS nb_Remplacant,
                                                                ROUND(SUM(CASE WHEN m.gagnant = "My Team" THEN 1 ELSE 0 END) / COUNT(p.id_Joueur) * 100, 2) AS nb_victoire
                                                                FROM participe p, matchs m
                                                                WHERE p.id_Match = m.id_Match
                                                                AND p.id_Joueur = :id_Joueur');
                                    $c->execute(array(
                                        'id_Joueur' => $joueur['id_Joueur']
                                    ));
                                    $Stat = $c->fetch();

                                    $c = $db->prepare('SELECT ROUND(AVG(p.evaluation), 2) AS moyenne_note
                                                                FROM participe p
                                                                WHERE p.evaluation >= 0
                                                                AND p.id_Joueur = :id_Joueur');
                                    $c->execute([
                                        'id_Joueur' => $joueur['id_Joueur']
                                    ]);
                                    $note = $c->fetch();
                            ?>
                                    <tr>
                                        <td><?= $joueur['nom'] ?></td>
                                        <td><?= $joueur['prenom'] ?></td>
                                        <td><?= "<img src='./img/players/" . $joueur['photo'] . "' width='100px' >" ?></td>
                                        <td><a href="./details-Joueur?id=<?= $joueur['id_Joueur'] ?>"><?= $joueur['pseudo'] ?></a></td>
                                        <td><?= $joueur['poste'] ?></td>
                                        <td><?= $joueur['statut'] ?></td>
                                        <td><?= $Stat['nb_Selection'] ?></td>
                                        <td><?= $Stat['nb_Titulaire'] ?></td>
                                        <td><?= $Stat['nb_Remplacant'] ?></td>
                                        <td><?= $Stat['nb_victoire'] ?>%</td>
                                        <td><?= $note['moyenne_note'] ?>/5</td>
                                    </tr>

                            <?php
                                }
                            } else {
                                echo "Aucun utilisateur trouvé";
                            }
                            ?>
                        </table>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script> 
                            //generer le graphique
                            var ctx = document.getElementById('myChart');
                            new Chart(ctx, {
                                type: 'doughnut',
                                data: {
                                    labels: ['Victoires', 'Défaites'],
                                    datasets: [{
                                        data: [<?= $nb_victoire?>, <?= $nb_defaite?>],
                                        backgroundColor: ['green', 'red'],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Ratio de victoires'
                                    },
                                    animation: {
                                        animateScale: true,
                                        animateRotate: true
                                    }
                                }
                            });
                        </script>

                        <script>
                            function sortTable(n) {
                                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
                                table = document.getElementById("sortTable");
                                switching = true;
                                dir = "desc";
                                while (switching) {
                                    switching = false;
                                    rows = table.rows;
                                    for (i = 1; i < (rows.length - 1); i++) {
                                        shouldSwitch = false;
                                        x = rows[i].getElementsByTagName("TD")[n];
                                        y = rows[i + 1].getElementsByTagName("TD")[n];
                                        if (dir == "asc") {
                                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                                shouldSwitch = true;
                                                break;
                                            }
                                        } else if (dir == "desc") {
                                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                                shouldSwitch = true;
                                                break;
                                            }
                                        }
                                    }
                                    if (shouldSwitch) {
                                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                                        switching = true;
                                        switchcount++;
                                    } else {
                                        if (switchcount == 0 && dir == "desc") {
                                            dir = "asc";
                                            switching = true;
                                        }
                                    }
                                }
                            }
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
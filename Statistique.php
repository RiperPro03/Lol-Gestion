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
                        $q = $db->prepare('SELECT count(id_Match) as nbMatch from matchs');
                        $q->execute();
                        if ($q->rowCount() > 0) {
                            $nbMatch = $q->fetch();
                        } else {
                            $nbMatch['nbMatch'] = 0;
                        }
                        ?>

                        <h2> Statistique Globale</h2>
                        <p> Nombre de match: <span> <?= $nbMatch['nbMatch'] ?> </span></p>
                        <p> Nombre de victoire: <span> 5 ,50%</span></p>
                        <p> Nombre de defaite: <span> 5 ,50%</span></p>
                    </div>
                </div>
                <div class="boiteStatParJoueur">
                    <h2 class="titreStatJ">Statistique par joueur</h2>

                    <form method="post">
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
                                <th>Nombre de selection titulaire</th>
                                <th>Nombre de selection Remplacant</th>
                                <th>Ratio de victoire</th>
                                <th>Moyenne Note</th>
                            </tr>
                            <?php
                                if (isset($_POST['search'])) {
                                    if (empty($_POST['search'])) {
                                        $q = $db->prepare('SELECT id_Joueur, nom, prenom, photo, pseudo, poste, statut FROM joueurs');
                                        $q->execute();
                                    } else {
                                        $recherche = htmlspecialchars($_POST['search']);
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
                                ?>
                                        <tr>
                                            <td><?= $joueur['nom'] ?></td>
                                            <td><?= $joueur['prenom'] ?></td>
                                            <td><?= "<img src='vue-img.php?img=" . $joueur['photo'] . "' width='100px' >" ?></td>
                                            <td><a href="./details-Joueur?id=<?= $joueur['id_Joueur'] ?>"><?= $joueur['pseudo'] ?></a></td>
                                            <td><?= $joueur['poste'] ?></td>
                                            <td><?= $joueur['statut'] ?></td>
                                            <td><?= "0" ?></td>
                                            <td><?= "0" ?></td>
                                            <td><?= "0" ?></td>
                                            <td><?= "0" ?></td>
                                            <td><?= "0" ?></td>
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
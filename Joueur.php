<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Joueur</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="./img/content/logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/joueur.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>

<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <h1>Joueurs</h1>

        <div class="zoneRecherche">
            <form method="post">
                <div class="BarreRecherche">
                    <input list="list-equipe" id="inputE" type="search" name="search" placeholder="Rechercher un Joueur" autocomplete="off">
                    <datalist id="list-equipe">
                        <?php
                        $q = $db->prepare('SELECT pseudo FROM joueurs');
                        $q->execute();


                        if ($q->rowCount() > 0) {
                            while ($joueur = $q->fetch()) {
                        ?>
                                <?= "<option value='" . $joueur['pseudo'] . "'>" ?>

                        <?php
                            }
                        } else {
                            echo "<option value='Aucun joueur trouvé'>";
                        }
                        ?>
                    </datalist>
                    <div class="recherche"></div>
                </div>
                <div class="reload"><a href="./Joueur"><i class="fa-solid fa-rotate-right"></i></a></div>
                <div class="ajout"><a href="./saisie-Joueur.php"><i class="fa-solid fa-user-plus"></i></a></div>
            </form>
            
        </div>

        <div class="listeJoueurs">
            <?php
                if (isset($_POST['search'])) {
                    if (empty($_POST['search'])) {
                        $q = $db->prepare('SELECT id_Joueur, nom, prenom, pseudo, poste, photo FROM joueurs');
                        $q->execute();
                    } else {
                        $recherche = htmlspecialchars($_POST['search']);
                        $q = $db->prepare('SELECT id_Joueur, nom, prenom, pseudo, poste, photo FROM joueurs 
                                            WHERE nom LIKE "%' . $recherche . '%" 
                                            OR prenom LIKE "%' . $recherche . '%" 
                                            OR pseudo LIKE "%' . $recherche . '%" 
                                            OR poste LIKE "%' . $recherche . '%"');
                        $q->execute();
                    }
                } else {
                    $q = $db->prepare('SELECT id_Joueur, nom, prenom, pseudo, poste, photo FROM joueurs');
                    $q->execute();
                }

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
                        $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], $Stat['nb_victoire'],$Stat['nb_Selection']);
                        $cartejoueur->setIdJoueur($joueur['id_Joueur']);
                        echo $cartejoueur->get_carteJoueur();

                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                }
            ?>
        </div>
    </div>
</body>

</html>
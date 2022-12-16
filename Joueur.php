<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';

    global $db;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TEST-joueurs</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="vue-img.php?img=logo.png">
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
            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="get">
                <div class="BarreRecherche">
                    <input type="search" name="search" placeholder="Rechercher un Joueur">
                    <div class="recherche"></div>
                </div>
                <div class="reload"><a href="./Joueur"><i class="fa-solid fa-rotate-right"></i></a></div>
            </form>
            
        </div>

        <div class="listeJoueurs">
            <?php
                if (isset($_GET['search'])) {
                    if (empty($_GET['search'])) {
                        $q = $db->prepare('SELECT nom, prenom, pseudo, poste, photo FROM joueurs');
                        $q->execute();
                    } else {
                        $recherche = htmlspecialchars($_GET['search']);
                        $q = $db->prepare('SELECT nom, prenom, pseudo, poste, photo FROM joueurs 
                                            WHERE nom LIKE "%' . $recherche . '%" 
                                            OR prenom LIKE "%' . $recherche . '%" 
                                            OR pseudo LIKE "%' . $recherche . '%" 
                                            OR poste LIKE "%' . $recherche . '%"');
                        $q->execute();
                    }
                } else {
                    $q = $db->prepare('SELECT nom, prenom, pseudo, poste, photo FROM joueurs');
                    $q->execute();
                }

                if ($q->rowCount() > 0) {
                    while ($joueur = $q->fetch()) {
                        $joueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                        echo $joueur->get_carteJoueur();

                    }
                } else {
                    echo '<p>Aucun Joueur trouvé</p>';
                }
            ?>
        </div>
    </div>
</body>

</html>
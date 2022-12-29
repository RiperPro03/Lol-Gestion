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
            <form method="post">
                <div class="BarreRecherche">
                    <input type="search" name="search" placeholder="Rechercher un Joueur">
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
                        $c = $db->prepare('SELECT count(id_Joueur) as nbSelec FROM appartient where id_Joueur = :id_Joueur group by id_Joueur');
                        $c->execute(['id_Joueur' => $joueur['id_Joueur']]);
                        if ($c->rowCount() > 0) {
                            $StatSelc = $c->fetch();
                        }else{
                            $StatSelc['nbSelec'] = 0;
                        }
                        $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, $StatSelc['nbSelec']);
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
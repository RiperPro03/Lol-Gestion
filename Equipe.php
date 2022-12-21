<?php
    require 'includes/header.php';
    require 'includes/Carte-Equipe.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Equipe</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/equipe.css">
    <link rel="stylesheet" href="./css/carteEquipe.css">
</head>

<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <h1>Equipe</h1>

        <div class="zoneRecherche">
            <form method="post">
                <div class="BarreRecherche">
                    <input type="search" name="search" placeholder="Rechercher une Equipe">
                    <div class="recherche"></div>
                </div>
                <div class="reload"><a href="./Equipe"><i class="fa-solid fa-rotate-right"></i></a></div>
                <div class="ajout"><a href="./saisie-Equipe.php"><i class="fa-solid fa-user-plus"></i></a></div>
            </form>
            
        </div>

        <div class="listeEquipe">
            <?php
                if (isset($_POST['search'])) {
                    if (empty($_POST['search'])) {
                        $q = $db->prepare('SELECT * FROM equipes');
                        $q->execute();
                    } else {
                        $recherche = htmlspecialchars($_POST['search']);
                        $q = $db->prepare('SELECT * FROM equipes
                                            WHERE nom LIKE "%' . $recherche . '%"');
                        $q->execute();
                    }
                } else {
                    $q = $db->prepare('SELECT * FROM equipes');
                    $q->execute();
                }

                if ($q->rowCount() > 0) {
                    while ($equipe = $q->fetch()) {
                        $carteEquipe = new CarteEquipe($equipe['nom']);
                        $carteEquipe->setIdEquipe($equipe['id_Equipe']);
                        echo $carteEquipe->get_carteEquipe();
                    }
                } else {
                    echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                }
            ?>
        </div>
    </div>
</body>

</html>
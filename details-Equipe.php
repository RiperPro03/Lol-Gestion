<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM equipes WHERE id_Equipe = :id_Equipe");
        $q->execute([
            'id_Equipe' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $equipe = $q->fetch();
        } else {
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Détails Equipe</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/detailsEquipe.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>

    <div class="corps">
        <div class="boutonRetour">
            <div class="retour">
                <a href="" >
                    <img src="vue-img.php?img=turn-left.png" style="width: 100%;">
                </a>
            </div>
        </div>
        <div class="boiteDetailsEquipe">
            <div class="contourDetails">
            </div>
            <div class="boiteTexte">
                <div class="titre">
                    <h2>Details Equipe</h2>
                </div>
                <div class="detailsInfoEquipe">
                    <p>
                        Nom :<span> <?= htmlspecialchars($equipe['nom']); ?></span>
                    </p>
                    <div class="ajout"><a href="./ajout-Joueur-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-user-plus"></i></a></div>
                    
                    <p> Joueurs :</p>
                        <?php
                            $q = $db->prepare('SELECT * FROM joueurs j INNER JOIN appartient a ON j.id_Joueur = a.id_Joueur WHERE a.id_Equipe = :id_Equipe');
                            $q->execute([
                                'id_Equipe' => $equipe['id_Equipe']
                            ]);
                    
                            if ($q->rowCount() > 0) {
                                while ($joueur = $q->fetch()) {
                                    $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                    $cartejoueur->setIdJoueur($joueur['id_Joueur']);
                                    $cartejoueur->setIdEquipe($equipe['id_Equipe']);
                                    echo $cartejoueur->get_carteJoueurPourDetails();
                    
                                }
                            } else {
                                echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                            }
                        ?>
                    
                </div>
            </div>
            <div class="optionDetails">
                <a href="modification-Equipe?id=<?= $equipe['id_Equipe'] ?>" class="boutonDetail"><i class="fa-solid fa-pen"></i></a>
                <a href="suppression-Equipe?id=<?= $equipe['id_Equipe'] ?>" class="boutonDetail"><i class="fa-solid fa-trash"></i></a>
                <a href="selection-Joueur?id=<?= $equipe['id_Equipe'] ?>" class="boutonDetail"><i class="fa-solid fa-users-gear"></i></a>
            </div>
        </div>
    </div>
    
</body>
</html>
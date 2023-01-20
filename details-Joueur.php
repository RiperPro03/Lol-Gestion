<?php
    require 'includes/header.php';
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM joueurs WHERE id_Joueur = :id_Joueur");
        $q->execute([
            'id_Joueur' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $joueur = $q->fetch();
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
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>LoL Gestion | Détails Joueur</title>
    <link rel="icon" href="./img/content/logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/detailsJoueur.css">
</head>
<body>
    <?php
        require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="boutonRetour">
            <div class="retour">
                <a href="javascript:history.back()" >
                    <img src="./img/content/icone/turn-left.png" style="width: 100%;">
                </a>
            </div>
        </div>
        <div class="boiteDetailsJoueur">
            <div class="contourDetails">
            </div>
            <div class="boiteTexte">
                <div class="titre">
                    <h2>Details Joueur</h2>
                </div>
                <div class="detailsInfoJoueur">
                    <div class="contourImage">
                        <div class="imageJoueur"><?= "<img src='./img/players/" . $joueur['photo'] . "' style='width:100%;' >" ?></div>
                    </div>
                    <p>
                        Pseudo :<span> <?= $joueur['pseudo'] ?></span>
                    </p>
                    <p>
                        nom : <span> <?= $joueur['nom'] ?></span>
                    </p>
                    <p>
                        Prenom : <span> <?= $joueur['prenom'] ?></span>
                    </p>
                    <p> Date de naissance : <span><?= date('d/m/Y', strtotime($joueur['date_naissance'])) ?></span></p>
                    <p>Taille : <span> <?= $joueur['taille'] ?> cm</span></p>
                    <p>Poids : <span><?= $joueur['poids'] ?> Kg</span></p>
                    <p>Poste : <span><?= $joueur['poste'] ?></span></p>
                    <p>Statut :<span><?= $joueur['statut'] ?></span></p>
                    <p>Commentaire Joueur :</br> <span> <?= $joueur['commentaire'] ?></span></p>
                    <p><span></span></p>
                </div>
            </div>
            <div class="optionDetails">
                <a href="modification-Joueur?id=<?= $joueur['id_Joueur'] ?>" class="boutonDetail"><i class="fa-solid fa-pen"></i></a>
                <a href="suppression-Joueur?id=<?= $joueur['id_Joueur'] ?>" class="boutonDetail"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT id_Match FROM matchs WHERE id_Match = :id_Match");
        $q->execute([
            'id_Match' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $match = $q->fetch();
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
    <link rel="icon" href="./img/content/logo.png">
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
                <a href="./details-Match?id=<?= $match['id_Match'] ?>" >
                    <img src="./img/content/icone/turn-left.png" style="width: 100%;">
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
                    
                    <p> Joueurs titulaire:</p>
                    <?php
                        
                        $q = $db->prepare('SELECT j.*
                                            FROM joueurs j 
                                            JOIN participe p ON p.id_joueur = j.id_Joueur 
                                            JOIN matchs m ON m.id_Match = p.id_match 
                                            WHERE m.id_Match = :id_Match
                                            AND p.titulaire = :titulaire
                                            ORDER BY FIELD(poste,\'Top\', \'Jungle\', \'Middle\', \'Bottom\', \'Support\')
                                            ');
                        $q->execute([
                            'id_Match' => $match['id_Match'],
                            'titulaire' => 1
                        ]);
                
                        if ($q->rowCount() > 0) {
                            while ($joueur = $q->fetch()) {
                                $listeJoueurTitulaire[$joueur['poste']] = $joueur;
                                $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                $cartejoueur->setIdJoueur($joueur['id_Joueur']);
                                $cartejoueur->setIdMatch($match['id_Match']);
                                echo $cartejoueur->get_carteJoueurPourDetails();
                            }
                        } else {
                            echo '<div class="noResult"> <p><span>Aucun Joueur trouvé</span></p></div>';
                        }
                    ?>
                    <p> Joueurs Remplaçant:</p>
                    <?php
                        $q = $db->prepare('SELECT j.*
                                            FROM joueurs j 
                                            JOIN participe p ON p.id_joueur = j.id_Joueur 
                                            JOIN matchs m ON m.id_Match = p.id_match 
                                            WHERE m.id_Match = :id_Match
                                            AND p.titulaire != :titulaire
                                            ORDER BY FIELD(poste,\'Top\', \'Jungle\', \'Middle\', \'Bottom\', \'Support\')
                        ');
                        $q->execute([
                            'id_Match' => $match['id_Match'],
                            'titulaire' => 1
                        ]);
                
                        if ($q->rowCount() > 0) {
                            while ($joueur = $q->fetch()) {
                                $listeJoueurTitulaire[$joueur['poste']] = $joueur;
                                $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                $cartejoueur->setIdJoueur($joueur['id_Joueur']);
                                $cartejoueur->setIdMatch($match['id_Match']);
                                echo $cartejoueur->get_carteJoueurPourDetails();
                            }
                        } else {
                            echo '<div class="noResult"> <p><span>Aucun Remplaçant trouvé</span></p></div>';
                        }
                    ?>
                </div>
            </div>
            <div class="optionDetails">
                <a href="./ajout-Joueur-Equipe?id=<?= $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-user-plus"></i></a>
                <a href="selection-Joueur?id=<?= $match['id_Match'] ?>" class="boutonDetail"><i class="fa-solid fa-users-gear"></i></a>
            </div>
        </div>
    </div>
    
</body>
</html>
<?php
    require 'includes/Carte-Equipe.php';
    require 'includes/header.php';
    require 'includes/choix-Joueur.php';
    require 'includes/Carte-Joueur.php'
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Sélection Joueurs</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/selectionJoueur.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <h3>Sélection des joueurs</h3>
            <form method="post">

                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">
                   
                        <?php
                            $q = $db->prepare('SELECT j.* FROM joueurs j INNER JOIN participe p ON j.id_Joueur = p.id_Joueur AND j.statut = :statut WHERE p.id_Match = :id_Match');
                            $q->execute([
                                'id_Match' => $match['id_Match'],
                                'statut' => 'actif'
                            ]);
                        
                            if ($q->rowCount() > 0) {
                                while ($joueur = $q->fetch()) {
                                    $c = $db->prepare('SELECT titulaire FROM participe WHERE id_Match = :id_Match AND id_Joueur = :id_Joueur');
                                    $c->execute([
                                        'id_Match' => $match['id_Match'],
                                        'id_Joueur' => $joueur['id_Joueur']
                                    ]);
                                    $titulaire = $c->fetch();
                                    $carteJoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                    $carteJoueur->setIdJoueur($joueur['id_Joueur']);
                                    $carteJoueur->setIdMatch($match['id_Match']);
                                    echo '<div class="checkJoueur">';
                                    echo $carteJoueur->get_carteJoueurSelection();
                                    if ($titulaire['titulaire'] == 1) {
                                        echo '<div class="checkTitulaire"> <label>Titulaire</label> <input type="checkbox" id="checkbox"name="Joueurs[]" value="' . $joueur['id_Joueur'] . '" checked></div></div>';
                                    } else {
                                        echo '<div class="checkTitulaire"><label>Titulaire</label> <input type="checkbox" id="checkbox" name="Joueurs[]" value="' . $joueur['id_Joueur'] . '"></div></div>';
                                    }        
                                }
                            } else {
                                echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                            }
                        ?> 
                <div class="option">  
                    <div class="ajout">
                        <a href="./ajout-Joueur-Equipe?id=<?= $match['id_Match'] ?>"><i class="fa-solid fa-user-plus"></i></a>
                    </div>
                    <a href="javascript:history.back()">Retour</a>
                    <input type="submit" name="formsend" value="Envoyer" class="button">
                </div>  
            </form>
        </div>
    </div>
</body>
</html>
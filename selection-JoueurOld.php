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
            <div class="ajout">
                <a href="./ajout-Joueur-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-user-plus"></i></a>
            </div>
            <form method="post">

                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

                <?php
                    $q = $db->prepare('SELECT j.* FROM joueurs j INNER JOIN appartient a ON j.id_Joueur = a.id_Joueur AND j.statut = :statut WHERE a.id_Equipe = :id_Equipe');
                     $q->execute([
                        'id_Equipe' => $equipe['id_Equipe'],
                        'statut' => 'actif'
                    ]);
                
                    if ($q->rowCount() > 0) {
                        while ($joueur = $q->fetch()) {
                            $c = $db->prepare('SELECT titulaire FROM appartient WHERE id_Equipe = :id_Equipe AND id_Joueur = :id_Joueur');
                            $c->execute([
                                'id_Equipe' => $equipe['id_Equipe'],
                                'id_Joueur' => $joueur['id_Joueur']
                            ]);
                            $titulaire = $c->fetch();
                            $carteJoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                            $carteJoueur->setIdJoueur($joueur['id_Joueur']);
                            $carteJoueur->setIdEquipe($equipe['id_Equipe']);
                            echo $carteJoueur->get_carteJoueurSelection();
                            if ($titulaire['titulaire'] == 1) {
                                echo '<input type="checkbox" name="Joueurs[]" value="' . $joueur['id_Joueur'] . '" checked> <br>';
                            } else {
                                echo '<input type="checkbox" name="Joueurs[]" value="' . $joueur['id_Joueur'] . '"> <br>';
                            }        
                        }
                    } else {
                        echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                    }
                ?>
                        
                <a href="javascript:history.back()">Retour</a>
                <input type="submit" name="formsend" value="Envoyer" class="button">
            </form>
        </div>
    </div>
</body>
</html>
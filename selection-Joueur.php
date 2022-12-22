<?php
    require 'includes/Carte-Equipe.php';
    require 'includes/header.php';
    require 'includes/choix-Joueur.php';
    
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
</head>
<body>

    <a href="javascript:history.back()">Retour</a>
    <h3>Sélection des joueurs</h3>
    <div class="ajout"><a href="./ajout-Joueur-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-user-plus"></i></a></div>
    <form method="post">

        <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

        <?php
            $q = $db->prepare('SELECT j.id_Joueur, j.pseudo FROM joueurs j INNER JOIN appartient a ON j.id_Joueur = a.id_Joueur AND j.statut = :statut WHERE a.id_Equipe = :id_Equipe');
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
                    echo '<label>' . $joueur['pseudo'] . '</label>';
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
            

        <input type="submit" name="formsend" value="Envoyer" class="button">
    </form>
</body>
</html>
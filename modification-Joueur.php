<?php
require 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Modification Joueur</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="./img/content/logo.png">
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/modif-Joueur.php'; ?>

            <h3>Modification d'un joueur</h3>

            <form method="post" enctype="multipart/form-data">

                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">

                <?= "<img src='./img/players/" . $joueur['photo'] . "' width='100px' >" ?>

                <div class="inputBox">
                    <input type="text" name="nom" required="required" autocomplete="off" value="<?= htmlspecialchars($joueur['nom']); ?>">
                    <span>Nom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="prenom" required="required" autocomplete="off" value="<?= htmlspecialchars($joueur['prenom']); ?>">
                    <span>Prenom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="pseudo" required="required" autocomplete="off" value="<?= htmlspecialchars($joueur['pseudo']); ?>">
                    <span>Pseudo</span>
                </div>

                <div class="inputBox">
                    <input type="date" name="date_naissance" required="required" autocomplete="off" value="<?=$joueur['date_naissance']?>">
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="300" name="taille" required="required" autocomplete="off" value="<?= htmlspecialchars($joueur['taille']); ?>">
                    <span>Taille</span>
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="9999999999" name="poids" required="required" autocomplete="off" value="<?= htmlspecialchars($joueur['poids']); ?>">
                    <span>Poids</span>
                </div>

                <div class="box">
                    <span>Poste</span>
                    <select name="poste" required="required">
                        <option value="Top" <?php if ($joueur['poste'] == "Top") echo "selected"; ?>>Top</option>
                        <option value="Jungle" <?php if ($joueur['poste'] == "Jungle") echo "selected"; ?>>Jungle</option>
                        <option value="Middle" <?php if ($joueur['poste'] == "Middle") echo "selected"; ?>>Middle</option>
                        <option value="Bottom" <?php if ($joueur['poste'] == "Bottom") echo "selected"; ?>>Bottom</option>
                        <option value="Support" <?php if ($joueur['poste'] == "Support") echo "selected"; ?>>Support</option>
                        <option value="Tout" <?php if ($joueur['poste'] == "Tout") echo "selected"; ?>>Tout</option>
                    </select>
                </div>

                <div class="box">
                    <span>Statut</span>
                    <select name="statut" required="required">
                        <option value="Actif" <?php if ($joueur['statut'] == "Actif") echo "selected"; ?>>Actif</option>
                        <option value="Blesse" <?php if ($joueur['statut'] == "Blesse") echo "selected"; ?>>Blessé</option>
                        <option value="Suspendu" <?php if ($joueur['statut'] == "Suspendu") echo "selected"; ?>>Suspendu</option>
                        <option value="Absent" <?php if ($joueur['statut'] == "Absent") echo "selected"; ?>>Absent</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="commentaire" autocomplete="off" value="<?= htmlspecialchars($joueur['commentaire']); ?>">
                    <span>Commentaire</span>
                </div>

                <div class="box">
                    <span>Photo</span>
                    <input type="file" name="photo">
                </div>
                <div class="option">
                    <a href="./details-Joueur?id=<?= htmlspecialchars($joueur['id_Joueur'])?>">Retour</a>
                    <input type="submit" name="formsend" value="Envoyer" class="button">
                </div> 
            </form>
        </div>
    </div>

</body>

</html>
<?php
    require './includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Saisie Joueur</title>
    <link rel="stylesheet" href="./css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
    
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/ajout-Joueur.php';?>

            <a href="index.php">HOME</a>
            <h3>Saisie d'un joueur</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

                <div class="inputBox">
                    <input type="text" name="nom" required="required">
                    <span>Nom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="prenom" required="required">
                    <span>Prenom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="pseudo" required="required">
                    <span>Pseudo</span>
                </div>

                <div class="inputBox">
                    <input type="date" name="date_naissance" required="required">
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="300" name="taille" required="required">
                    <span>Taille</span>
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="9999999999" name="poids" required="required">
                    <span>Poids</span>
                </div>

                <div class="box">
                    <span>Poste</span>
                    <select name="poste" required="required">
                        <choice/>
                        <option value="Top">Top</option>
                        <option value="Jungle">Jungle</option>
                        <option value="Middle">Middle</option>
                        <option value="Bottom">Bottom</option>
                        <option value="Support">Support</option>
                    </select>
                </div>

                <div class="box">
                    <span>Statut</span>
                    <select name="statut" required="required">
                        <option value="Actif">Actif</option>
                        <option value="Blesse">Blessé</option>
                        <option value="Suspendu">Suspendu</option>
                        <option value="Absent">Absent</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="commentaire">
                    <span>Commentaire</span>
                </div>

                <div class="box">
                    <span>Photo</span>
                    <input type="file" name="photo" required="required">
                </div>

                <input type="submit" name="formsend" value="Ajouter" class="button">
            </form>
        </div>
    </div>
</body>

</html>
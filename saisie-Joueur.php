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
    <link rel="icon" href="./img/content/logo.png">
    
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/ajout-Joueur.php';?>

            
            <h3>Saisie d'un joueur</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

                <div class="inputBox">
                    <input type="text" name="nom" required="required" autocomplete="off">
                    <span>Nom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="prenom" required="required" autocomplete="off">
                    <span>Prenom</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="pseudo" required="required" autocomplete="off">
                    <span>Pseudo</span>
                </div>

                <div class="inputBox">
                    <input type="date" name="date_naissance" required="required" autocomplete="off">
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="300" name="taille" required="required" autocomplete="off">
                    <span>Taille</span>
                </div>

                <div class="inputBox">
                    <input type="number" min="0" max="9999999999" name="poids" required="required" autocomplete="off">
                    <span>Poids</span>
                </div>

                <div class="box">
                    <span>Poste</span>
                    <select name="poste" required="required">
                        <option value="Top">Top</option>
                        <option value="Jungle">Jungle</option>
                        <option value="Middle">Middle</option>
                        <option value="Bottom">Bottom</option>
                        <option value="Support">Support</option>
                        <option value="Tout">Tout</option>
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
                    <input type="text" name="commentaire" autocomplete="off">
                    <span>Commentaire</span>
                </div>

                <div class="box">
                    <span>Photo</span>
                    <input type="file" name="photo" required="required">
                </div>
                <div class="option">
                    <a href="javascript:history.back()">Retour</a>
                    <input type="submit" name="formsend" value="Ajouter" class="button">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
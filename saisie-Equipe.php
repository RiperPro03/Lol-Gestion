<?php
    require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Saisie Equipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=lol.jpg">
</head>
<body>
<div class="container">
        <div class="card">

            <?php require 'includes/ajout-Equipe.php' ?>

            <a href="index.php">HOME</a>
            <h3>Saisie d'une équipe</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

                <div class="inputBox">
                    <input type="text" max= 50 name="nom" required="required">
                    <span>Nom d'équipe</span>
                </div>

                <div class="inputBox">
                    <input type="text" max=3 name="prefixe" required="required">
                    <span>Préfixe</span>
                </div>

                <input type="submit" name="formsend" value="Ajouter" class="button">
            </form>
        </div>
    </div>
    
</body>
</html>
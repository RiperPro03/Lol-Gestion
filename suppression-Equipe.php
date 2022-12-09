<?php
    require 'includes/header.php';

    require 'includes/supp-Equipe.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Supprimer Equipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer l'équipe : </p>
            <p>Nom : <?= $equipe['nom'] ?></p>
            <p>Prefixe : <?= $equipe['prefixe'] ?></p>
            <form method="post">
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">
                <p>
                    <input type="submit" name="reponse" value="Oui" class="button">
                    <input type="submit" name="reponse" value="Annuler" class="button">
                </p>
            </form>
        </div>
    </div>

</body>

</html>
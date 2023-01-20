<?php
    require 'includes/header.php';

    require 'includes/supp-Match.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Supprimer Match</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="./img/content/logo.png">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer le Match : </p>
            <p>Date : <?= date('d/m/Y', strtotime($match['date_match'])) ?></p>
            <p>Heure : <?= date('H:i', strtotime($match['heure_match'])) ?></p>
            <p>Lieu : <?= $match['lieu'] ?></p>
            <p>Equipe adverse : <?= $match['equipe_adverse'] ?></p>
            <form method="post">
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">
                <div class="option">
                    <input type="submit" name="reponse" value="Annuler" class="button">
                    <input type="submit" name="reponse" value="Oui" class="button">
                </div>
            </form>
        </div>
    </div>

</body>

</html>
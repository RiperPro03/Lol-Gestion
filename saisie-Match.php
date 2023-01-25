<?php
    require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Saisie match</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="./img/content/logo.png">
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/ajout-Match.php';?>
            
            <h3>Saisie d'un match</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="return validateForm()">

                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">

                <div class="inputBox">
                    <input type="date" name="date_match" required="required" autocomplete="off">
                </div>

                <div class="inputBox">
                    <input type="time" name="heure_match" required="required" autocomplete="off">
                </div>

                <div class="box">
                    <span>Lieu</span>
                    <select name="lieu" required="required">
                        <option value="Domicile">Domicile</option>
                        <option value="Extérieur">Extérieur</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="equipe_adverse" required="required" autocomplete="off">
                    <span>Equipe adverse</span>
                </div>
                <div class="option">
                    <a href="./Match.php">Retour</a>
                    <input type="submit" name="formsend" value="Ajouter" class="button">
                </div>
            </form>
        </div>
    </div>
</body>

</html>
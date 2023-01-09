<?php
require 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Modification Match</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/modif-Match.php'; ?>

            <h3>Modification d'un match</h3>

            <form method="post" onsubmit="return validateForm()">

                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">

                <div class="inputBox">
                    <input type="date" name="date_match" required="required" autocomplete="off" value="<?= $match['date_match']?>">
                </div>

                <div class="inputBox">
                    <input type="time" name="heure_match" required="required" autocomplete="off" value="<?= date('H:i', strtotime($match['heure_match']))?>">
                </div>

                <div class="box">
                    <span>Lieu</span>
                    <select name="lieu" required="required">
                        <option value="Domicile" <?php if ($match['lieu'] == "Domicile") echo "selected"; ?>>Domicile</option>
                        <option value="Extérieur" <?php if ($match['lieu'] == "Extérieur") echo "selected"; ?>>Extérieur</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="description_match" autocomplete="off" value="<?= htmlspecialchars($match['description_match']);?>">
                    <span>Description</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="score" autocomplete="off" value="<?= htmlspecialchars($match['score']);?>">
                    <span>Score</span>
                </div>

                <div class="box">
                    <span>Gagnant</span>
                    <select name="gagnant" required="required">
                        <option value="<?= htmlspecialchars($match['equipe_adverse']);?>" <?php if ($match['gagnant'] == htmlspecialchars($match['equipe_adverse'])) echo "selected"; ?>><?= htmlspecialchars($match['equipe_adverse']);?></option>
                        <option value="Mon équipe" <?php if ($match['gagnant'] == "Mon équipe") echo "selected"; ?>>Mon équipe</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="equipe_adverse" required="required" autocomplete="off" value="<?= htmlspecialchars($match['equipe_adverse']);?>">
                    <span>Equipe adverse</span>
                </div>
                <a href="javascript:history.back()">Retour</a>
                <input type="submit" name="formsend" value="Envoyer" class="button">
            </form>
        </div>
    </div>
</body>

</html>
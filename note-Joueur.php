<?php
require 'includes/header.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Noter Joueur</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="./img/content/logo.png">
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/note-Joueur.php'; ?>

            <h3>Noter un joueur</h3>

            <form method="post" enctype="multipart/form-data">

                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">

                <p>Nom : <?= $joueur['nom'] ?></p>
                <p>Prenom : <?= $joueur['prenom'] ?></p>
                <p><?= "<img src='./img/players/" . $joueur['photo'] . "' width='80px' >" ?></p>

                <div class="notes">
                    <label>Note :</label>
                    <input type="number" name="note" min="0" max="5" pattern="^[0-5]$" required="required" value="<?php if($participe['evaluation'] >=0) htmlspecialchars($participe['evaluation']); ?>">
                </div>


                <div class="option">
                    <a href="./details-Equipe?id=<?= htmlspecialchars($participe['id_Match'])?>">Retour</a>
                    <input type="submit" name="formsend" value="Envoyer" class="button">
                </div>
            </form>
        </div>
    </div>

</body>

</html>
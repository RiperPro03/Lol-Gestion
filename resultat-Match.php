<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>LoL Gestion | Saisie résultat match</title>
    <link rel="icon" href="./img/content/logo.png">
    <link rel="stylesheet" href="./css/saisieApresMatch.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>

<body>

    <?php require 'includes/apres-Match.php'; ?>

    <div class="container">
        <div class="card">
            <h1>Saisie des resultat : </h1>
            <form method="post">
                <h2>Resultat du match</h2>
                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">
                <span>Entrer le score dans le format <strong>0:0</strong></span>
                <div class="Resultat">
                    <div class="inputBox">
                        <input type="text" name="score" pattern="^([0-9]+):([0-9]+)$" required="required" autocomplete="off">
                        <span>Score</span>
                    </div>
                    <div class="box">
                        <label>Gagnant</label>
                        <select name="gagnant" required="required">
                            <option value="<?= htmlspecialchars($match['equipe_adverse']); ?>" <?php if ($match['gagnant'] == htmlspecialchars($match['equipe_adverse'])) echo "selected"; ?>><?= htmlspecialchars($match['equipe_adverse']); ?></option>
                            <option value="My Team" <?php if ($match['gagnant'] == "My Team") echo "selected"; ?>>My Team</option>
                        </select>
                    </div>
                </div>

                <div class="bouton">
                    <a href="./details-Match?id=<?= $match['id_Match'] ?>">Retour</a>
                    <input type="submit" name="formsend" value="Valider" class="button">
                </div>

            </form>
        </div>
    </div>
</body>

</html>
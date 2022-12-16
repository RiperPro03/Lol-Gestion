<?php
require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Saisie Match</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>

<body>
    <div class="container">
        <div class="card">

            <?php require 'includes/ajout-Match.php';?>
            <a href="./">HOME</a>
            <h3>Saisie d'un match</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

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
                        <option value="Domicile">Actif</option>
                        <option value="Extérieur">Blessé</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="description_equipe" autocomplete="off">
                    <span>Description</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="gagnant" autocomplete="off">
                    <span>Gagnant</span>
                </div>

                <div class="box">
                    <span>Equipe</span>
                    <input list="list-equipe" id="inputE" type="text" name="equipe" required="required" autocomplete="off">
                    <datalist id="list-equipe">
                        <?php
                        $q = $db->prepare('SELECT nom FROM equipes');
                        $q->execute();


                        if ($q->rowCount() > 0) {
                            while ($equipe = $q->fetch()) {
                        ?>
                                <?= "<option value='" . $equipe['nom'] . "'>" ?>

                        <?php
                            }
                        } else {
                            echo "<option value='Aucune équipe trouvé'>";
                        }
                        ?>
                    </datalist>
                </div>

                <input type="submit" name="formsend" value="Ajouter" class="button">
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var input = document.getElementById("inputE");
            var datalist = document.getElementById("list-equipe");
            var isValid = false;

            for (var i = 0; i < datalist.options.length; i++) {
                if (input.value == datalist.options[i].value) {
                    isValid = true;
                    break;
                }
            }

            if (!isValid) {
                alert("Veuillez sélectionner une équipe valide dans la liste");
            }

            return isValid;
        }
    </script>
</body>

</html>
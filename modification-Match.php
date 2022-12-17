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

            <a href="javascript:history.back()">Retour</a>
            <h3>Modification d'un match</h3>

            <form method="post" onsubmit="return validateForm()">

                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">

                <div class="inputBox">
                    <input type="date" name="date_match" required="required" autocomplete="off" value=<?= $match['date_match']?>>
                </div>

                <div class="inputBox">
                    <input type="time" name="heure_match" required="required" autocomplete="off" value=<?= date('H:i', strtotime($match['heure_match']))?>>
                </div>

                <div class="box">
                    <span>Lieu</span>
                    <select name="lieu" required="required">
                        <option value="Domicile" <?php if ($match['lieu'] == "Domicile") echo "selected"; ?>>Domicile</option>
                        <option value="Extérieur" <?php if ($match['lieu'] == "Extérieur") echo "selected"; ?>>Extérieur</option>
                    </select>
                </div>

                <div class="inputBox">
                    <input type="text" name="description_match" autocomplete="off" value=<?= $match['description_match']?>>
                    <span>Description</span>
                </div>

                <div class="inputBox">
                    <input type="text" name="gagnant" autocomplete="off" value=<?= $match['gagnant']?>>
                    <span>Gagnant</span>
                </div>

                <div class="box">
                    <span>Equipe</span>
                    <input list="list-equipe" id="inputE" type="text" name="equipe" required="required" autocomplete="off" value=<?= $nom_equipe['nom']?>>
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

                <div class="inputBox">
                    <input type="text" name="equipe_adverse" required="required" autocomplete="off" value=<?= $match['equipe_adverse']?>>
                    <span>Equipe adverse</span>
                </div>

                <input type="submit" name="formsend" value="Envoyer" class="button">
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
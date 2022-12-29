<?php
    require 'includes/header.php';
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Ajout Joueur</title>
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="vue-img.php?img=logo.png">
</head>
<body>
<div class="container">
        <div class="card">

            <?php require 'includes/ajout-Joueur-Equipe.php'?>

            
            <h3>Ajouter un joueur dans l'équipe : <?= $equipe['nom']?></h3>


            <form method="post" onsubmit="return validateForm()">
                
                <input type="hidden" name="token" value="<?=$_SESSION['authToken']?>">

                <div class="ajout"><a href="./saisie-Joueur"><i class="fa-solid fa-user-plus"></i></a></div>

                <div class="box">
                    <span>Joueur</span>
                    <input list="list-joueur" id="inputJ" type="text" name="pseudo_joueur" required="required" autocomplete="off" >
                    <datalist id="list-joueur">
                        <?php
                        $q = $db->prepare('SELECT pseudo FROM joueurs WHERE pseudo NOT IN(SELECT pseudo FROM joueurs j INNER JOIN appartient a ON j.id_Joueur = a.id_Joueur WHERE a.id_Equipe = :id_Equipe)');
                        $q->execute([
                            'id_Equipe' => $equipe['id_Equipe']
                        ]);

                        if ($q->rowCount() > 0) {
                            while ($joueur = $q->fetch()) {
                        ?>
                                <?= "<option value='" . htmlspecialchars($joueur['pseudo']) . "'>" ?>

                        <?php
                            }
                        } else {
                            echo "<option value='Aucun joueur trouvé'>";
                        }
                        ?>
                    </datalist>
                </div>
                <a href="javascript:history.back()">Retour</a>
                <input type="submit" name="formsend" value="Ajouter" class="button">
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            var input = document.getElementById("inputJ");
            var datalist = document.getElementById("list-joueur");
            var isValid = false;

            for (var i = 0; i < datalist.options.length; i++) {
                if (input.value == datalist.options[i].value) {
                    if(input.value == 'Aucun joueur trouvé') {
                        alert("Veuillez ajouté un joueur avant de l'ajouter à une équipe");
                    } else {
                        isValid = true;
                        break;
                    }
                }
            }

            if (!isValid) {
                alert("Veuillez sélectionner un joueur valide dans la liste");
            }

            return isValid;
        }
    </script>
    
</body>
</html>
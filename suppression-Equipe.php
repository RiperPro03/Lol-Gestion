<?php
    require 'includes/header.php';

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT nom, prefixe FROM equipes WHERE id_Equipe = :id_Equipe");
        $q->execute([
            'id_Equipe' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $equipe = $q->fetch();
        } else {
            header("Location:index.php");
        }
        
    } else {
        header("Location:index.php");
    }

    if (isset($_POST['reponse'])) {
        $reponse = $_POST['reponse'];
        if (strcmp($reponse,"Oui") == 0) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $q = $db->prepare("DELETE FROM equipes WHERE id_Equipe = :id_Equipe");
                $q->execute([
                    'id_Equipe' => $id
                ]);
            }
        }
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Supprimer Equipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="img/logo/lol.jpg">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer l'équipe : </p>
            <p>Nom : <?= $equipe['nom'] ?></p>
            <p>Prefixe : <?= $equipe['prefixe'] ?></p>
            <form method="post">
                <p>
                    <input type="submit" name="reponse" value="Oui" class="button">
                    <input type="submit" name="reponse" value="Annuler" class="button">
                </p>
            </form>
        </div>
    </div>

</body>

</html>
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Modification Equipe</title>
    <link rel="stylesheet" href="css/form-saisie.css">
    <link rel="icon" href="img/logo/lol.jpg">
</head>
<body>
<div class="container">
        <div class="card">

            <?php require 'includes/modif-Equipe.php'?>

            <a href="index.php">HOME</a>
            <h3>Modification d'une équipe</h3>

            <form method="post">
                <div class="inputBox">
                    <input type="text" max= 50 name="nom" required="required" value=<?= $equipe['nom'] ?>>
                    <span>Nom d'équipe</span>
                </div>

                <div class="inputBox">
                    <input type="text" max=3 name="prefixe" required="required" value=<?= $equipe['prefixe'] ?>>
                    <span>Préfixe</span>
                </div>

                <input type="submit" name="formsend" value="Envoyer" class="button">
            </form>
        </div>
    </div>
</body>
</html>
<?php
require 'includes/header.php';

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $q = $db->prepare("SELECT nom, prenom, photo FROM joueurs WHERE id_Joueur = :id_Joueur");
    $q->execute([
        'id_Joueur' => $id
    ]);
    $nbc = $q->rowCount();
    if($nbc == 1) {
        $joueur = $q->fetch();
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
            $q = $db->prepare("DELETE FROM joueurs WHERE id_Joueur = :id_Joueur");
            $q->execute([
                'id_Joueur' => $id
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
    <title>Supprimer Joueur | LoL Gestion</title>
    <link rel="stylesheet" href="css/form-saisie.css">
</head>

<body>
    <div class="container">
        <div class="card">
            <p>Voulez vous suprimer le Contact : </p>
            <p>Nom : <?= $joueur['nom'] ?></p>
            <p>Prenom : <?= $joueur['prenom'] ?></p>
            <p><?= "<img src='./img/players/".$joueur['photo']."' width='80px' >"?></p>
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
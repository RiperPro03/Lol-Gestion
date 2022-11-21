<?php
require 'includes/db.php';
global $db;
session_start();
if (!(isset($_SESSION['user']))) {
    header('Location:login.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion</title>
    <link rel="icon" href="img/logo/lol.jpg">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1>Vous êtes connecté en tant que : <?= $_SESSION['user']; ?></h1>
    <a href="logout.php">Déconnection</a>

    <table>
        <tr class="item">
            <td>Nom</td>
            <td>Prénom</td>
            <td>Photo</td>
            <td>Numéro License</td>
            <td>Date de naissance</td>
            <td>Taille</td>
            <td>Poids</td>
            <td>Poste</td>
            <td>Statut</td>
            <td>Commentaire</td>
            <td>Supprimer</td>
            <td><a href="saisie-Joueur.php">Ajouter <i class="fa-solid fa-plus"></i></a></td>
        </tr>
        <?php

            $q = $db->prepare('SELECT * FROM joueurs');
            $q->execute();
            

            if ($q->rowCount() > 0) {
                while ($joueur = $q->fetch()) {
        ?>
                    <tr>
                        <td><?= $joueur['nom'] ?></td>
                        <td><?= $joueur['prenom'] ?></td>
                        <td><?= "<img src='vue-img.php?id=".$joueur['photo']."' width='50px' >"?></td>
                        <td><?= $joueur['num_License'] ?></td>
                        <td><?= date('d-m-Y', strtotime($joueur['date_naissance'])); ?></td>
                        <td><?= $joueur['taille'] ?></td>
                        <td><?= $joueur['poids'] ?></td>
                        <td><?= $joueur['poste'] ?></td>
                        <td><?= $joueur['statut'] ?></td>
                        <td><?= $joueur['commentaire'] ?></td>
                        <td><a href="#?id_Joueur=<?= $joueur['id_Joueur'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                        <td><a href="suppression-Joueur.php?id=<?= $joueur['id_Joueur'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                    </tr>

        <?php
                }
            } else {
                echo "Aucun utilisateur trouvé";
            }
            
        ?>
    </table>

</body>

</html>
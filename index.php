<?php
require 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-accueil.css">
    

</head>

<body>

    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div>
            <h1>Vous êtes connecté en tant que : <?= $_SESSION['user']; ?></h1>
            <a href="logout.php">Déconnection</a>
        </div>
        <div>
            <h2>Joueur</h2>
            <table>
                <tr class="item">
                    <td>Nom</td>
                    <td>Prénom</td>
                    <td>Photo</td>
                    <td>Pseudo</td>
                    <td>Date de naissance</td>
                    <td>Taille</td>
                    <td>Poids</td>
                    <td>Poste</td>
                    <td>Statut</td>
                    <td>Commentaire</td>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <td><a href="saisie-Joueur">Ajouter <i class="fa-solid fa-plus"></i></a></td>
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
                            <td><?= "<img src='vue-img.php?img=" . $joueur['photo'] . "' width='100px' >" ?></td>
                            <td><?= $joueur['pseudo'] ?></td>
                            <td><?= date('d-m-Y', strtotime($joueur['date_naissance'])); ?></td>
                            <td><?= $joueur['taille'] ?></td>
                            <td><?= $joueur['poids'] ?></td>
                            <td><?= $joueur['poste'] ?></td>
                            <td><?= $joueur['statut'] ?></td>
                            <td><?= $joueur['commentaire'] ?></td>
                            <td><a href="modification-Joueur?id=<?= $joueur['id_Joueur'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                            <td><a href="suppression-Joueur?id=<?= $joueur['id_Joueur'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>

                <?php
                    }
                } else {
                    echo "Aucun utilisateur trouvé";
                }

                ?>
            </table>
        </div>

        <div>
            <h2>Equipe</h2>
            <table>
                <tr class="item">
                    <td>Nom de l'équipe</td>
                    <td>Préfixe</td>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <td><a href="saisie-Equipe">Ajouter <i class="fa-solid fa-plus"></i></a></td>
                </tr>
                <?php

                $q = $db->prepare('SELECT * FROM equipes');
                $q->execute();


                if ($q->rowCount() > 0) {
                    while ($equipe = $q->fetch()) {
                ?>
                        <tr>
                            <td><a href="#?id=<?= $equipe['id_Equipe'] ?>"><?= $equipe['nom'] ?></a></td>
                            <td><?= $equipe['prefixe'] ?></td>
                            <td><a href="modification-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                            <td><a href="suppression-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>

                <?php
                    }
                } else {
                    echo "Aucune équipe trouvé";
                }

                ?>
            </table>
        </div>

        <div>
            <h2>Match</h2>
            <table>
                <tr class="item">
                    <td>Nom de l'équipe</td>
                    <td>Préfixe</td>
                    <td>Modifier</td>
                    <td>Supprimer</td>
                    <td><a href="saisie-Equipe">Ajouter <i class="fa-solid fa-plus"></i></a></td>
                </tr>
                <?php

                $q = $db->prepare('SELECT * FROM equipes');
                $q->execute();


                if ($q->rowCount() > 0) {
                    while ($equipe = $q->fetch()) {
                ?>
                        <tr>
                            <td><a href="#?id=<?= $equipe['id_Equipe'] ?>"><?= $equipe['nom'] ?></a></td>
                            <td><?= $equipe['prefixe'] ?></td>
                            <td><a href="modification-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-pen"></i></a></td>
                            <td><a href="suppression-Equipe?id=<?= $equipe['id_Equipe'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>

                <?php
                    }
                } else {
                    echo "Aucune équipe trouvé";
                }

                ?>
            </table>
        </div>
    </div>


</body>

</html>
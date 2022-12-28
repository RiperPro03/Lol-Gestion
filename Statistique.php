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
    <title>LoL Gestion | Statistique</title>
    <link rel="icon" href="vue-img.php?img=logo.png">
    <link rel="stylesheet" href="./css/nav-bar.css">
    <link rel="stylesheet" href="./css/TEST-Statistique.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>
    <?php
    require 'includes/nav-bar.html';
    ?>
    <div class="corps">
        <div class="boiteDetailsStat">
            <div class="contourStat">
            </div>
            <div class="boiteTexte">
                <h2 class="titre">Statistique</h2>
                <div class="boiteStatGeneral">

                </div>
                <div class="boiteStatParJoueur">
                    <div class="bouton">
                        <button type="submit"  onclick="openPopup()"> Joueurs</button>
                    </div>
                    <div class="popup" id="popup">
                        <h2> Joueurs</h2>
                        <div class="listeJoueur">
                        <?php 
                            $q = $db->prepare('SELECT id_Joueur, nom, prenom, pseudo, poste, photo FROM joueurs');
                            $q->execute();
                            if ($q->rowCount() > 0) {
                                while ($joueur = $q->fetch()) {
                                    $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                    $cartejoueur->setIdJoueur($joueur['id_Joueur']);
                                    echo $cartejoueur->get_carteJoueurDetail();
                                }
                            } else {
                                echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                            }
                        ?>
                        </div>
                        <button type="button" onclick="closePopup()"> Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let popup = document.getElementById("popup");

        function openPopup() {
            popup.classList.add("open-popup");
        }
        function closePopup() {
            popup.classList.remove("open-popup");
        }
    </script>
</body>
</html>
<?php
    require 'includes/header.php';
    require 'includes/Carte-Joueur.php';
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM joueurs WHERE id_Joueur = :id_Joueur");
        $q->execute([
            'id_Joueur' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $joueurStat = $q->fetch();
        } else {
            header("Location:./");
        }
    }
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
        <h2 class="titre">Statistique</h2>
        <div class="boiteDetailsStat">
            <div class="contourStat">
            </div>
            <div class="boiteTexte">
                
                <div class="boiteStatGeneral">
                    <div class="statGeneral">
                        <?php 
                            $q = $db->prepare('SELECT count(id_Match) as nbMatch from matchs');
                            $q->execute();
                            if ($q->rowCount() > 0) {
                                $nbMatch = $q->fetch();
                            } else {
                                $nbMatch['nbMatch'] = 0;
                            }
                        ?>

                        <h2> Statistique Globale</h2>
                        <p> Nombre de match: <span> <?= $nbMatch['nbMatch']?> </span></p>
                        <p> Nombre de victoire: <span> 5 ,50%</span></p>
                        <p> Nombre de defaite: <span> 5 ,50%</span></p>
                    </div>
                </div>
                <div class="boiteStatParJoueur">
                    <h2 class="titreStatJ">Statistique par joueur</h2>
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
                                    echo $cartejoueur->get_carteJoueurStat();
                                }
                            } else {
                                echo '<div class="noResult"> <p >Aucun Joueur trouvé</p></div>';
                            }
                        ?>
                        </div>
                        <button type="button" onclick="closePopup()"> Fermer</button>
                    </div>
                    <div class="tableauStatJ" id="tableauStatJ">
                        <table>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Pseudo</th>
                                <th>Poste</th>
                                <th>Nombre de selection</th>
                                <th>Nombre de selection titulaire</th>
                                <th>Nombre de selection Remplacant</th>
                                <th>Ratio de victoire</th>
                                <th>Note</th>
                            </tr>
                            <tr>
                                <?php 
                                    if(isset($joueurStat) && !empty($joueurStat)) {
                                        echo '<td>'.$joueurStat['nom'].'</td>
                                        <td>'.$joueurStat['prenom'].'</td>
                                        <td>'.$joueurStat['pseudo'].'</td>
                                        <td>'.$joueurStat['poste'].'</td>
                                        <td>'.'15'.'</td>
                                        <td>'.'10'.'</td>
                                        <td>'.'5'.'</td>
                                        <td>'.'50%'.'</td>
                                        <td>'.'4.6'.'</td>';  
                                    }else{
                                        echo '
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>'; 
                                    }?>
                            </tr>
                        </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let popup = document.getElementById("popup");
        let tableau = document.getElementById("tableauStatJ");

        function openPopup() {
            popup.classList.add("open-popup");
            tableau.classList.add("popupActive");
        }
        function closePopup() {
            popup.classList.remove("open-popup");
            tableau.classList.remove("popupActive");
        }
    </script>
</body>
</html>
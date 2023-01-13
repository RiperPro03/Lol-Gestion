<?php 
    require 'includes/Carte-Joueur.php';
    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>TEST-saisie apres match</title>
    <link rel="stylesheet" href="./css/TEST-saisieApresMatch.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Saisie des resultat : </h1>
            <form action="">
                <h2>Resultat du match</h2>
                <div class="Resultat">
                    <div class="inputBox">
                        <input type="text" name="Score" pattern="^([0-9]+):([0-9]+)$" required="required" autocomplete="off">
                        <span>Score</span>
                    </div>
                    <div class="box">
                        <label>Gagnant</label>
                        <select name="statut" required="required">
                            <option value="SKT T1">SKT T1</option>
                            <option value="Adversaire">Adversaire</option>
                        </select>
                    </div>
                </div>
                
                <h2>Notes</h2>
                <div class="boxCard">
                    <?php  $image = '637a7214430be5.13956557.png';
                            $joueur = new CarteJoueur('su','lee','Lebon','Bot',$image,'12','15');
                            for( $i = 0; $i < 5; $i++){
                                echo '
                                    <div class="joueurEquipe">
                                            '.$joueur->get_carteJoueurStat().'
                                        <div class="notes">
                                            <label for="">Note</label>
                                            <input type="number" min="0" max="5">
                                        </div>
                                    </div>
                    ';}?>
                </div>

                <div class="bouton">
                    <a href="javascript:history.back()">Retour</a>
                    <input type="submit" name="formsend" value="Valider" class="button">
                </div>

            </form>
        </div>
    </div>
</body>
</html>
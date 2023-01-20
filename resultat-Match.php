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
    <script src="https://kit.fontawesome.com/acf8d5192c.js" crossorigin="anonymous"></script>
    <title>LoL Gestion | Saisie résultat match</title>
    <link rel="icon" href="./img/content/logo.png">
    <link rel="stylesheet" href="./css/TEST-saisieApresMatch.css">
    <link rel="stylesheet" href="./css/carteJoueur.css">
</head>

<body>

    <?php require 'includes/apres-Match.php'; ?>

    <div class="container">
        <div class="card">
            <h1>Saisie des resultat : </h1>
            <form action="post">
                <h2>Resultat du match</h2>
                <input type="hidden" name="token" value="<?= $_SESSION['authToken'] ?>">
                <span>Entrer le score dans le format <strong>0:0</strong></span>
                <div class="Resultat">
                    <div class="inputBox">
                        <input type="text" name="Score" pattern="^([0-9]+):([0-9]+)$" required="required" autocomplete="off">
                        <span>Score</span>
                    </div>
                    <div class="box">
                        <label>Gagnant</label>
                        <select name="gagnant" required="required">
                            <option value="<?= htmlspecialchars($match['equipe_adverse']); ?>" <?php if ($match['gagnant'] == htmlspecialchars($match['equipe_adverse'])) echo "selected"; ?>><?= htmlspecialchars($match['equipe_adverse']); ?></option>
                            <option value="My Team" <?php if ($match['gagnant'] == "My Team") echo "selected"; ?>>My Team</option>
                        </select>
                    </div>
                </div>

                <h2>Notes</h2>
                <div class="boxCard">
                    <?php
                        
                        $q = $db->prepare('SELECT j.*
                                            FROM joueurs j 
                                            JOIN participe p ON p.id_joueur = j.id_Joueur 
                                            JOIN matchs m ON m.id_Match = p.id_match 
                                            WHERE m.id_Match = :id_Match
                                            AND p.titulaire = :titulaire
                                            ORDER BY FIELD(poste,\'Top\', \'Jungle\', \'Middle\', \'Bottom\', \'Support\')
                                            ');
                        $q->execute([
                            'id_Match' => $match['id_Match'],
                            'titulaire' => 1
                        ]);
                
                        if ($q->rowCount() > 0) {
                            while ($joueur = $q->fetch()) {
                                $cartejoueur = new CarteJoueur($joueur['nom'], $joueur['prenom'], $joueur['pseudo'], $joueur['poste'], $joueur['photo'], 0, 0);
                                echo '
                                    <div class="joueurEquipe">
                                            ' . $cartejoueur->get_carteJoueurStat() . '
                                        <div class="notes">
                                            <label>Note</label>
                                            <input type="number" name="NoteJ[]" min="0" max="5" required="required">
                                        </div>
                                    </div>';
                            }
                        } else {
                            echo '<div class="noResult"> <p><span>Aucun Joueur trouvé</span></p></div>';
                        }
                    ?>
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
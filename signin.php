<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="card">

            <?php
            require 'includes/db.php';
            global $db;
            if (isset($_POST['formsend'])) {

                extract($_POST);

                if (!empty($suser) && !empty($spass) && !empty($cpass)) {

                    if ($spass == $cpass) {
                        $option = ['cost' => 12];
                        $hashpass = password_hash($spass, PASSWORD_BCRYPT, $option); //Pour crypter un MDP

                        $c = $db->prepare("SELECT utilisateur FROM users WHERE utilisateur = :utilisateur");
                        $c->execute([
                            'utilisateur' => $suser
                        ]);
                        $nbUser = $c->rowCount();

                        if ($nbUser == 0) {
                            $q = $db->prepare("INSERT INTO users (utilisateur, password) VALUES(:utilisateur,:password)");
                            $q->execute([
                                'utilisateur' => $suser,
                                'password' => $hashpass
                            ]);
                            echo "Le compte a été créé ";
                        } else {
                            echo "Ce nom Utilisateur existe déjà ";
                        }
                    }
                }
            }
            ?>

            <h3>S'enregistrer</h3>

            <form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="inputBox">
                    <input type="text" name="suser" required="required">
                    <span>Utilisateur</span>
                </div>

                <div class="inputBox">
                    <input type="password" name="spass" required="required">
                    <span>Mot de passe</span>
                </div>

                <div class="inputBox">
                    <input type="password" name="cpass" required="required">
                    <span>Confirmer MDP</span>
                </div>

                <input type="submit" name="formsend" value="Singin" class="button">
            </form>
        </div>
    </div>
</body>

</html>
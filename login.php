<?php
    require 'includes/db.inc';
    global $db;
    session_start();
    if (isset($_SESSION['user'])) {
        header('Location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Connexion</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="icon" href="img/logo/lol.jpg">
</head>
<body>
<div class="card">
    
    <div class="box">
        <div class="form">
            <h2>Connexion</h2>
            <form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
                <div class="inputBox">
                    <input type="text" name="luser" required="required">
                    <span>Utilisateur</span>
                    <i></i>
                </div>
    
                <div class="inputBox">
                    <input type="password" name="lpass" required="required">
                    <span>Mot de passe</span>
                    <i></i>
                </div>
                <input type="submit" value="Connexion" name="formlogin">
            </form>
            <?php
                if (isset($_POST['formlogin'])) {

                    extract($_POST);
            
                    if(!empty($luser) && !empty($lpass)) {
            
                        $q = $db->prepare("SELECT * FROM users WHERE utilisateur = :utilisateur");
                        $q->execute([
                            'utilisateur' => $luser
                        ]);
                        $result = $q->fetch();
            
                        if($result) {
                            if(password_verify($lpass,$result['password'])) {
                                $_SESSION['user'] = $luser;
                                header('Location:index.php');
                            } else {
                                echo "MDP incorrect";
                            }
                        } else {
                            echo "L'utilisateur : ". $luser . " n'existe pas";
                        }
                    
                    } else {
                        echo "Veuiller remplir tout les champs";
                    }
                }
            ?>
        </div>
    </div>
    
</body>
</html>
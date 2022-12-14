<?php
    if (isset($_POST['formlogin'])) {

        extract($_POST);

        if (!empty($luser) && !empty($lpass)) {

            $q = $db->prepare("SELECT * FROM users WHERE utilisateur = :utilisateur");
            $q->execute([
                'utilisateur' => $luser
            ]);
            $result = $q->fetch();

            if ($result) {
                if (password_verify($lpass, $result['password'])) {
                    $_SESSION['user'] = $result['utilisateur'];
                    $token = openssl_random_pseudo_bytes(64);
                    $token = bin2hex($token);
                    $_SESSION['authToken'] = $token;
                    $_SESSION['authTokenExpire'] = time() + 3600;
                    header('Location:./');
                } else {
                    echo "MDP incorrect";
                }
            } else {
                echo "L'utilisateur : " . $luser . " n'existe pas";
            }
        } else {
            echo "Veuiller remplir tout les champs";
        }
    }
?>
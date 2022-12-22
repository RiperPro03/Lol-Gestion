<?php
    require 'db.php';
    global $db;
    session_start();
    if (!empty($_SESSION['authToken'])) {
        if (time() > $_SESSION['authTokenExpire']) {
            echo '<script>
                alert("Votre session a expiré, veuillez vous reconnecter");
                location.assign("./logout");
            </script>';
            exit;
        }
    } else {
        echo '<script>
                location.assign("./erreur401");
            </script>';
        exit;
    }
?>
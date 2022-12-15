<?php
    if (!empty($_SESSION['authToken']) && $token == $_SESSION['authToken']) {
        if (time() > $_SESSION['authTokenExpire']) {
            echo '<script>
                alert("Votre session a expiré, veuillez vous reconnecter");
                location.assign("./login");
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
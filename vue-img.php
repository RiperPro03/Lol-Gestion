<?php
    /*session_start();
    if (!(isset($_SESSION['authToken']))) {
        if (time() > $_SESSION['authTokenExpire']) {
            header('Location:login');
            exit;
        }
    }*/

    if(isset($_GET['img']) && !empty($_GET['img'])) {
        $chemin = "img/players/".$_GET['img'];
        if (file_exists($chemin)) {
            echo file_get_contents($chemin);

        } else {
            $chemin = "img/content/".$_GET['img'];
            if (file_exists($chemin)) {
                echo file_get_contents($chemin);
            } else {
                $chemin = "img/content/icone/".$_GET['img'];
                if (file_exists($chemin)){
                    echo file_get_contents($chemin);
                }else{
                header("Location:./");
                }
            }
        }
        
    } else {
        header("Location:./");
    }
?>
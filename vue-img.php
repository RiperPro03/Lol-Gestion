<?php
    session_start();
    if (!(isset($_SESSION['user']))) {
        header('Location:login.php');
    }

    if(isset($_GET['img']) && !empty($_GET['img'])) {
        $chemin = "img/players/".$_GET['img'];
        if (file_exists($chemin)) {
            echo file_get_contents($chemin);

        } else {
            $chemin = "img/content/".$_GET['img'];
            if (file_exists($chemin)) {
                echo file_get_contents($chemin);
            } else {
                header("Location:index.php");
            }
        }
        
    } else {
        header("Location:index.php");
    }
?>
<?php
    session_start();
    if (!(isset($_SESSION['user']))) {
        header('Location:login.php');
    }

    if(isset($_GET['img']) && !empty($_GET['img'])) {
        echo file_get_contents("img/players/".$_GET['img']);
        
    } else {
        header("Location:index.php");
    }
?>
<?php
    session_start();
    if (!(isset($_SESSION['user']))) {
        header('Location:login.php');
    }

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        echo file_get_contents("img/players/".$_GET['id']);
        
    } else {
        header("Location:index.php");
    }
?>
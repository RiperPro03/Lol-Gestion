<?php
    include 'db.php';
    global $db;
    session_start();
    if (!(isset($_SESSION['user']))) {
        header('Location:erreur403.php');
    }
?>
<?php
    include 'db.php';
    global $db;
    session_start();
    if (!(isset($_SESSION['authToken']))) {
        if (!(time() <= $_SESSION['authTokenExpire'])) {
            header('Location:erreur401.php');
            exit;
        }
    }
?>
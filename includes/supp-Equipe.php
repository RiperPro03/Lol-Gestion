<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT nom, prefixe FROM equipes WHERE id_Equipe = :id_Equipe");
        $q->execute([
            'id_Equipe' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $equipe = $q->fetch();
        } else {
            header("Location:index.php");
        }
        
    } else {
        header("Location:index.php");
    }

    if (isset($_POST['reponse'])) {

        extract($_POST);

        if (!empty($_SESSION['authToken']) && $token == $_SESSION['authToken']) {
            if (time() > $_SESSION['authTokenExpire']) {
                header('Location:login.php');
                exit;
            }
        } else {
            echo "Erreur le TOKEN d'acceès est invalide";
            exit;
        }

        if (strcmp($reponse,"Oui") == 0) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $q = $db->prepare("DELETE FROM equipes WHERE id_Equipe = :id_Equipe");
                $q->execute([
                    'id_Equipe' => $id
                ]);
            }
        }
        header("Location:index.php");
    }
?>
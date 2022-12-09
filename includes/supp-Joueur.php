<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT nom, prenom, photo FROM joueurs WHERE id_Joueur = :id_Joueur");
        $q->execute([
            'id_Joueur' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $joueur = $q->fetch();
        } else {
            header("Location:index.php");
        }
        
    } else {
        header("Location:index.php");
    }

    if (isset($_POST['reponse'])) {
        
        extract($_POST);

        if (!empty($_SESSION['authToken']) && $token == $_SESSION['authToken']) {
            if (!(time() <= $_SESSION['authTokenExpire'])) {
                header('Location:erreur401.php');
                exit;
            }
        } else {
            echo "Erreur le TOKEN d'acceès est invalide";
            exit;
        }

        if (strcmp($reponse,"Oui") == 0) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $q = $db->prepare("DELETE FROM joueurs WHERE id_Joueur = :id_Joueur");
                $q->execute([
                    'id_Joueur' => $id
                ]);
                if (unlink("./img/players/".$joueur['photo'])) {
                    echo "Le fichier a été supprimé avec succès.";
                } else {
                    echo "Il y a eu une erreur lors de la suppression du fichier.";
                }
            }
        }
        header("Location:index.php");
    }
?>
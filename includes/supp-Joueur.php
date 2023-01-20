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
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }

    if (isset($_POST['reponse'])) {
        
        extract($_POST);

        include 'authToken-form.php';

        if (strcmp($reponse,"Oui") == 0) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $q = $db->prepare("DELETE FROM joueurs WHERE id_Joueur = :id_Joueur");
                $q->execute([
                    'id_Joueur' => $id
                ]);
                if (unlink("./img/players/".$joueur['photo'])) {
                    echo "Le fichier a été supprimé avec succès.";
                } else {
                    echo '<script>alert("Il y a eu une erreur lors de la suppression du fichier");</script>';
                    exit;
                }
                header("Location:./Joueur");
            }
        }
        header('Location:./details-Joueur?id='.$id.'');
    }
?>
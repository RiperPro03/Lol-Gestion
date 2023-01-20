<?php
    if(isset($_GET['idJ']) && !empty($_GET['idJ']) && isset($_GET['idM']) && !empty($_GET['idM'])) {
        $id_J = $_GET['idJ'];
        $id_M = $_GET['idM'];
        $q = $db->prepare("SELECT id_Joueur, id_Match, evaluation FROM participe WHERE id_Joueur = :id_Joueur AND id_Match = :id_Match");
        $q->execute([
            'id_Joueur' => $id_J,
            'id_Match' => $id_M
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $participe = $q->fetch();
            $c = $db->prepare("SELECT nom, prenom, photo FROM joueurs WHERE id_Joueur = :id_Joueur");
            $c->execute([
                'id_Joueur' => $participe['id_Joueur']
            ]);
            $joueur = $c->fetch();
            
        } else {
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }

    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if(!empty($note)) {
            if ($note <= 5 && $note >= 0) {
                $q = $db->prepare("UPDATE participe set evaluation = :evaluation WHERE id_Joueur = :id_Joueur AND id_Match = :id_Match");
                $q->execute([
                    'evaluation' => $note,
                    'id_Joueur' => $participe['id_Joueur'],
                    'id_Match' => $participe['id_Match']
                ]);

                header('Location:./details-Equipe?id='.$participe['id_Match'].'');
            } else {
                echo '<script>alert("Erreur le format de la note pas respecté");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }

?>
<?php
    if(isset($_GET['idJ']) && !empty($_GET['idJ']) && isset($_GET['idE']) && !empty($_GET['idE'])) {
        $id_J = $_GET['idJ'];
        $id_E = $_GET['idE'];
        $q = $db->prepare("SELECT id_Joueur, id_Equipe FROM appartient WHERE id_Joueur = :id_Joueur AND id_Equipe = :id_Equipe");
        $q->execute([
            'id_Joueur' => $id_J,
            'id_Equipe' => $id_E
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $appartient = $q->fetch();
            $c = $db->prepare("SELECT id_Equipe, nom FROM equipes WHERE id_Equipe = :id_Equipe");
            $c->execute([
                'id_Equipe' => $appartient['id_Equipe']
            ]);
            $equipe = $c->fetch();
            $c = $db->prepare("SELECT nom, prenom, photo FROM joueurs WHERE id_Joueur = :id_Joueur");
            $c->execute([
                'id_Joueur' => $appartient['id_Joueur']
            ]);
            $joueur = $c->fetch();
            
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
            $q = $db->prepare("DELETE FROM appartient WHERE id_Joueur = :id_Joueur AND id_Equipe = :id_Equipe");
            $q->execute([
                'id_Joueur' => $appartient['id_Joueur'],
                'id_Equipe' => $appartient['id_Equipe']
            ]);
        }
        header('Location:./details-Equipe?id='.$equipe['id_Equipe'].'');
    }
?>
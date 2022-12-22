<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT id_Equipe, nom FROM equipes WHERE id_Equipe = :id_Equipe");
        $q->execute([
            'id_Equipe' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $equipe = $q->fetch();
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
                $q = $db->prepare("DELETE FROM equipes WHERE id_Equipe = :id_Equipe");
                $q->execute([
                    'id_Equipe' => $equipe['id_Equipe']
                ]);
                $q = $db->prepare("DELETE FROM appartient WHERE id_Equipe = :id_Equipe");
                $q->execute([
                    'id_Equipe' => $equipe['id_Equipe']
                ]);
            }
        }
        header("Location:./");
    }
?>
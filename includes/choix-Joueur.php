<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM equipes WHERE id_Equipe = :id_Equipe");
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


    if (isset($_POST['formsend'])) {
        extract($_POST);

        if (isset($Joueurs) && !empty($Joueurs) && count($Joueurs) == 5) {
            $q = $db->prepare("UPDATE appartient set titulaire = :titulaire WHERE id_Equipe = :id_Equipe");
            $q->execute([
                'id_Equipe' => $equipe['id_Equipe'],
                'titulaire' => 0
            ]);
            foreach ($Joueurs as $id_joueur) {
                $q = $db->prepare("UPDATE appartient set titulaire = 1 WHERE id_Equipe = :id_Equipe AND id_Joueur = :id_Joueur");
                $q->execute([
                    'id_Equipe' => $equipe['id_Equipe'],
                    'id_Joueur' => $id_joueur
                ]);
            }
            header('Location:./details-Equipe?id='.$equipe['id_Equipe'].'');
        } else {
            echo '<script>alert("Vous devez sélectionner 5 joueur");</script>';
        }

    }
    
?>
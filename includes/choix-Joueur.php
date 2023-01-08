<?php 
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM matchs WHERE id_Match = :id_Match");
        $q->execute([
            'id_Match' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $match = $q->fetch();
        } else {
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }


    if (isset($_POST['formsend'])) {
        extract($_POST);

        if (isset($Joueurs) && !empty($Joueurs) && count($Joueurs) == 5) {
            $q = $db->prepare("UPDATE participe set titulaire = :titulaire WHERE id_Match = :id_Match");
            $q->execute([
                'id_Match' => $match['id_Match'],
                'titulaire' => 0
            ]);
            foreach ($Joueurs as $id_joueur) {
                $q = $db->prepare("UPDATE participe set titulaire = 1 WHERE id_Match = :id_Match AND id_Joueur = :id_Joueur");
                $q->execute([
                    'id_Match' => $match['id_Match'],
                    'id_Joueur' => $id_joueur
                ]);
            }
            header('Location:./details-Equipe?id='.$equipe['id_Equipe'].'');
        } else {
            echo '<script>alert("Vous devez sélectionner 5 joueur");</script>';
        }

    }
    
?>
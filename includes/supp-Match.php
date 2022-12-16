<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT date_match, heure_match, lieu FROM matchs WHERE id_Match  = :id_Match ");
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

    if (isset($_POST['reponse'])) {
        
        extract($_POST);

        include 'authToken-form.php';

        if (strcmp($reponse,"Oui") == 0) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $q = $db->prepare("DELETE FROM dispute WHERE id_Match = :id_Match");
                $q->execute([
                    'id_Match' => $id
                ]);
                $q = $db->prepare("DELETE FROM matchs WHERE id_Match = :id_Match");
                $q->execute([
                    'id_Match' => $id
                ]);
                
            }
        }
        header("Location:./");
    }
?>
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

        include 'authToken-form.php';

        if(!empty($score) && !empty($gagnant)) {
            
            $q = $db->prepare("UPDATE matchs set gagnant = :gagnant,
                                                score = :score
                                                WHERE id_Match = :id_Match");
            $q->execute([
                'gagnant' => $gagnant,
                'score' => $score,
                'id_Match' => $match['id_Match']
            ]);

            header('Location:./details-Match?id=' . $match['id_Match'] . '');
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
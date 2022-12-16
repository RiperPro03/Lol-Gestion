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
            $c = $db->prepare("SELECT e.nom FROM equipes e INNER JOIN dispute d ON e.id_Equipe = d.id_Equipe WHERE d.id_Match = :id_Match");
            $c->execute([
                'id_Match' => $id
            ]);
            $nom_equipe = $c->fetch();
        } else {
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }

    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if(!empty($date_match) && !empty($heure_match) && !empty($lieu) && !empty($equipe) && !empty($equipe_adverse)) {
            if (strlen($lieu) <= 50 && strlen($description_match) <= 50 && strlen($equipe_adverse) <= 50) {

                $c = $db->prepare("SELECT matchs.id_Match, equipes.id_Equipe FROM matchs, equipes 
                                            WHERE equipes.nom = :equipe
                                            AND matchs.date_match = :date_match
                                            AND matchs.heure_match = :heure_match
                                            AND matchs.id_Match != :id_Match");
                $c->execute([
                    'equipe' => $equipe,
                    'date_match' => $date_match,
                    'heure_match' => $heure_match,
                    'id_Match' => $id
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {
                    $q = $db->prepare("UPDATE matchs set date_match = :date_match, 
                                                        heure_match = :heure_match, 
                                                        lieu = :lieu, 
                                                        description_match = :description_match, 
                                                        gagnant = :gagnant, 
                                                        equipe_adverse = :equipe_adverse 
                                                        WHERE id_Match = :id_Match");
                    $q->execute([
                        'date_match' => $date_match,
                        'heure_match' => $heure_match,
                        'lieu' => $lieu,
                        'description_match' => $description_match,
                        'gagnant' => $gagnant,
                        'equipe_adverse' => $equipe_adverse,
                        'id_Match' => $id
                    ]);
                    
                    $c = $db->prepare("SELECT e.nom FROM equipes e INNER JOIN dispute d ON e.id_Equipe = d.id_Equipe WHERE d.id_Match = :id_Match");
                    $c->execute([
                        'id_Match' => $id
                    ]);
                    $nom_equipe = $c->fetch();

                    if($nom_equipe['nom'] != $equipe){
                        $q = $db->prepare("UPDATE dispute set id_Equipe = :id_Equipe WHERE id_Match = :id_Match");
                        $q->execute([
                            'id_Equipe' => $equipe,
                            'id_Match' => $id
                        ]);
                    }

                    header('Location:./');
                } else {
                    echo '<script>alert("Ce match existe déjà");</script>';
                }
            } else {
                echo '<script>alert("Erreur le lieu ou la description_match ou le nom de équipe adverse est trop long");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
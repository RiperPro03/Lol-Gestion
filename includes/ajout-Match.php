<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if(!empty($date_match) && !empty($heure_match) && !empty($lieu) && !empty($equipe_adverse)) {
            if (strlen($lieu) <= 50 && strlen($equipe_adverse) <= 50) {

                $c = $db->prepare("SELECT matchs.id_Match FROM matchs 
                                            WHERE matchs.date_match = :date_match
                                            AND matchs.heure_match = :heure_match");
                $c->execute([
                    'date_match' => $date_match,
                    'heure_match' => $heure_match,
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $q = $db->prepare("INSERT INTO matchs (date_match, heure_match, lieu, description_match, gagnant, score, equipe_adverse) VALUES(:date_match,:heure_match,:lieu,:description_match,:gagnant,:score,:equipe_adverse)");
                    $q->execute([
                        'date_match' => $date_match,
                        'heure_match' => $heure_match,
                        'lieu' => $lieu,
                        'description_match' => '',
                        'gagnant' => '',
                        'score' => '',
                        'equipe_adverse' => $equipe_adverse
                    ]);

                    header("Location:./details-Equipe?id=" . $db->lastInsertId() . "");

                } else {
                    echo '<script>alert("Cette équipe a déjà un match prévue pour cette date et heure ");</script>';
                }
            } else {
                echo '<script>alert("Erreur le lieu ou la description sont trop long");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
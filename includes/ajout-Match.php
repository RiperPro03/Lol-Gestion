<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        if (!empty($_SESSION['authToken']) && $token == $_SESSION['authToken']) {
            if (time() > $_SESSION['authTokenExpire']) {
                echo '<script>alert("Erreur le TOKEN d'.'acceès est expiré");</script>';
                header('Location:login');
                exit;
            }
        } else {
            echo '<script>alert("Erreur le TOKEN d'.'acceès est invalide");</script>';
            exit;
        }

        if(!empty($date_match) && !empty($heure_match) && !empty($lieu) && !empty($equipe)) {
            if (strlen($lieu) <= 50 && strlen($description_match) <= 50) {
                $c = $db->prepare("SELECT matchs.id_Match, equipes.id_Equipe FROM matchs, equipes 
                                            WHERE equipes.nom = :equipe
                                            AND matchs.date_match = :date_match
                                            AND matchs.heure_match = :heure_match");
                $c->execute([
                    'equipe' => $equipe,
                    'date_match' => $date_match,
                    'heure_match' => $heure_match
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $q = $db->prepare("INSERT INTO matchs (date_match, heure_match, lieu, description_match, gagnant) VALUES(:date_match,:heure_match,:lieu,:description_match,:gagnant)");
                    $q->execute([
                        'date_match' => $date_match,
                        'heure_match' => $heure_match,
                        'lieu' => $lieu,
                        'description_match' => $description_match,
                        'gagnant' => $gagnant
                    ]);
                    $c = $db->prepare("SELECT matchs.id_Match, equipes.id_Equipe FROM matchs, equipes 
                                            WHERE equipes.nom = :equipe
                                            AND matchs.date_match = :date_match
                                            AND matchs.heure_match = :heure_match
                                            AND matchs.lieu = :lieu
                                            AND matchs.description_match = :description_match
                                            AND matchs.gagnant = :gagnant");
                    $c->execute([
                        'equipe' => $equipe,
                        'date_match' => $date_match,
                        'heure_match' => $heure_match,
                        'lieu' => $lieu,
                        'description_match' => $description_match,
                        'gagnant' => $gagnant
                    ]);
                    $result = $c->fetch();

                    $q = $db->prepare("INSERT INTO dispute (id_Match, id_Equipe) VALUES(:id_Match,:id_Equipe)");
                    $q->execute([
                        'id_Match' => $result['id_Match'],
                        'id_Equipe' => $result['id_Equipe']
                    ]);

                    header("Location: " . $_SERVER['HTTP_REFERER']);

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
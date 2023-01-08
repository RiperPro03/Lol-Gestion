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

        if(!empty($pseudo_joueur)) {
            if (strlen($pseudo_joueur) <= 50) {
                $c = $db->prepare("SELECT id_Joueur FROM joueurs WHERE pseudo = :pseudo");
                $c->execute([
                    'pseudo' => $pseudo_joueur
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 1) {
                    $joueur = $c->fetch();
                    $q = $db->prepare('SELECT j.id_Joueur
                                        FROM joueurs j 
                                        JOIN participe p ON p.id_joueur = j.id_Joueur 
                                        JOIN matchs m ON m.id_Match = p.id_match 
                                        WHERE m.id_Match = :id_Match');
                    $q->execute([
                        'id_Match' => $match['id_Match']
                    ]);
                    $nbJoueur = $q->rowCount();
                    if ($nbJoueur < 7) {
                        $q = $db->prepare("INSERT INTO participe (id_Joueur,id_Match) VALUES(:id_Joueur,:id_Equipe)");
                        $q->execute([
                            'id_Joueur' => $joueur['id_Joueur'],
                            'id_Equipe' => $match['id_Match']
                        ]);

                        header('Location:./details-Equipe?id='.$match['id_Match'].'');
                    } else {
                        echo '<script>alert("Cette équipe est déjà complète");</script>';
                    }

                } else {
                    echo '<script>alert("Cette équipe existe déjà");</script>';
                }
            } else {
                echo '<script>alert("Erreur le nom est trop long");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
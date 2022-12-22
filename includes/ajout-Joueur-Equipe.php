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
                    $q = $db->prepare('SELECT * FROM joueurs j INNER JOIN appartient a ON j.id_Joueur = a.id_Joueur WHERE a.id_Equipe = :id_Equipe');
                    $q->execute([
                        'id_Equipe' => $equipe['id_Equipe']
                    ]);
                    $nbJoueur = $q->rowCount();
                    if ($nbJoueur < 7) {
                        $q = $db->prepare("INSERT INTO appartient (id_Joueur,id_Equipe) VALUES(:id_Joueur,:id_Equipe)");
                        $q->execute([
                            'id_Joueur' => $joueur['id_Joueur'],
                            'id_Equipe' => $equipe['id_Equipe']
                        ]);

                        header('Location:./details-Equipe?id='.$equipe['id_Equipe'].'');
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
<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT nom FROM equipes WHERE id_Equipe = :id_Equipe");
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

        if(!empty($nom)) {
            if(strlen($nom) <= 50) {
                $c = $db->prepare("SELECT id_Equipe FROM equipes WHERE nom = :nom AND id_Equipe != :id_Equipe");
                $c->execute([
                    'nom' => $nom,
                    'id_Equipe' => $id
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {
                    $q = $db->prepare("UPDATE equipes set nom = :nom WHERE id_Equipe = :id_Equipe");
                    $q->execute([
                        'nom' => $nom,
                        'id_Equipe' => $id
                    ]);

                    header('Location:./');
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
<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT nom, prefixe FROM equipes WHERE id_Equipe = :id_Equipe");
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

        if(!empty($nom) && !empty($prefixe)) {
            if(strlen($nom) <= 50 && strlen($prefixe) <= 4) {
                $c = $db->prepare("SELECT id_Equipe FROM equipes WHERE nom = :nom AND prefixe = :prefixe AND id_Equipe != :id_Equipe");
                $c->execute([
                    'nom' => $nom,
                    'prefixe' => $prefixe,
                    'id_Equipe' => $id
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {
                    $q = $db->prepare("UPDATE equipes set nom = :nom ,prefixe = :prefixe WHERE id_Equipe = :id_Equipe");
                    $q->execute([
                        'nom' => $nom,
                        'prefixe' => $prefixe,
                        'id_Equipe' => $id
                    ]);

                    header('Location:./');
                } else {
                    echo '<script>alert("Cette équipe existe déjà");</script>';
                }
            } else {
                echo '<script>alert("Erreur le nom ou le prefixe sont trop long");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
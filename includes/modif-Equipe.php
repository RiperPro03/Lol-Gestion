<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        if(!empty($nom) && !empty($prenom)) {
            if(strlen($nom) <= 50 && strlen($prefixe) <= 3) {
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

                    header('Location:index.php');
                } else {
                    echo "Cette équipe existe déjà ";
                }
            } else {
                echo "erreur le nom ou le prefixe sont trop long";
            }
            
        } else {
            echo "Veuillez erreur de saisie";
        }
    }
?>
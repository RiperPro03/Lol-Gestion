<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if(!empty($nom) && !empty($prefixe)) {
            if (strlen($nom) <= 50 && strlen($prefixe) <= 4) {
                $c = $db->prepare("SELECT id_Equipe FROM equipes WHERE nom = :nom");
                $c->execute([
                    'nom' => $nom
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $q = $db->prepare("INSERT INTO equipes (nom, prefixe) VALUES(:nom,:prefixe)");
                    $q->execute([
                        'nom' => $nom,
                        'prefixe' => $prefixe
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
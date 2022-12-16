<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if(!empty($nom)) {
            if (strlen($nom) <= 50) {
                $c = $db->prepare("SELECT id_Equipe FROM equipes WHERE nom = :nom");
                $c->execute([
                    'nom' => $nom
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $q = $db->prepare("INSERT INTO equipes (nom) VALUES(:nom)");
                    $q->execute([
                        'nom' => $nom,
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
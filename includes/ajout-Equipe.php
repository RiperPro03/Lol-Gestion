<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        if (!empty($_SESSION['authToken']) && $token == $_SESSION['authToken']) {
            if (!(time() <= $_SESSION['authTokenExpire'])) {
                header('Location:login.php');
                exit;
            }
        } else {
            echo "Erreur le TOKEN d'acceès est invalide";
            exit;
        }

        if(!empty($nom) && !empty($prefixe)) {
            if (strlen($nom) <= 50 && strlen($prefixe) <= 4) {
                $c = $db->prepare("SELECT id_Equipe FROM equipes WHERE nom = :nom");
                $c->execute([
                    'nom' => $nom,
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $q = $db->prepare("INSERT INTO equipes (nom, prefixe) VALUES(:nom,:prefixe)");
                    $q->execute([
                        'nom' => $nom,
                        'prefixe' => $prefixe
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
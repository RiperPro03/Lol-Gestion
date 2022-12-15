<?php
    if (isset($_POST['formsend'])) {

        extract($_POST);

        include 'authToken-form.php';

        if (!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($date_naissance) && 
            !empty($taille) && !empty($poids) && !empty($poste) && !empty($statut) && isset($_FILES['photo'])) {

            if (is_numeric($taille) && is_numeric($poids)) {

                $c = $db->prepare("SELECT id_Joueur FROM joueurs WHERE nom = :nom AND prenom = :prenom");
                $c->execute([
                    'nom' => $nom,
                    'prenom' => $prenom
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {

                    $tmpName = $_FILES['photo']['tmp_name'];
                    $name = $_FILES['photo']['name'];
                    $size = $_FILES['photo']['size'];
                    $error = $_FILES['photo']['error'];
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    $extensions = ['jpg', 'png', 'jpeg'];

                    if (in_array($extension, $extensions) && $error == 0 && $size <= 500000) {

                        $uniqueName = uniqid('', true);
                        $file = $uniqueName . "." . $extension;
                        move_uploaded_file($tmpName, './img/players/' . $file);

                        $q = $db->prepare("INSERT INTO joueurs (nom, prenom, photo, pseudo, date_naissance, taille, poids, statut, commentaire, poste) 
                                                    VALUES(:nom,:prenom,:photo,:pseudo,:date_naissance,:taille,:poids,:statut,:commentaire,:poste)");
                        $q->execute([
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'photo' => $file,
                            'pseudo' => $pseudo,
                            'date_naissance' => $date_naissance,
                            'taille' => $taille,
                            'poids' => $poids,
                            'statut' => $statut,
                            'commentaire' => $commentaire,
                            'poste' => $poste
                        ]);

                        header('Location:./');

                    } else {
                        echo '<script>alert("Une erreur est survenue avec la photo, extention ou la taille de la photo invalide");</script>';
                    }
                } else {
                    echo '<script>alert("Ce Joueur existe déjà");</script>';
                }
            } else {
                echo '<script>alert("Erreur la taille ou le poids ne sont pas valide");</script>';
            }
            
        } else {
            echo '<script>alert("Veuiller remplir tout les champs");</script>';
        }
    }
?>
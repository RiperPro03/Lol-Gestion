<?php
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
        $q = $db->prepare("SELECT * FROM joueurs WHERE id_Joueur = :id_Joueur");
        $q->execute([
            'id_Joueur' => $id
        ]);
        $nbc = $q->rowCount();
        if($nbc == 1) {
            $joueur = $q->fetch();
        } else {
            header("Location:index.php");
        }
        
    } else {
        header("Location:index.php");
    }

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

        if(!empty($nom) && !empty($prenom) && !empty($pseudo) && !empty($date_naissance) && 
            !empty($taille) && !empty($poids) && !empty($poste) && !empty($statut)) {
                
            if (is_numeric($taille) && is_numeric($poids)) {
                $c = $db->prepare("SELECT id_Joueur FROM joueurs WHERE nom = :nom AND prenom = :prenom AND id_Joueur != :id_Joueur");
                $c->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'id_Joueur' => $id
                ]);
                $nbUser = $c->rowCount();

                if ($nbUser == 0) {
                    $photo = $joueur['photo'];
                    if (isset($_FILES['photo'])) {
                        $tmpName = $_FILES['photo']['tmp_name'];
                        $name = $_FILES['photo']['name'];
                        $size = $_FILES['photo']['size'];
                        $error = $_FILES['photo']['error'];
                        $tabExtension = explode('.', $name);
                        $extension = strtolower(end($tabExtension));
                        $extensions = ['jpg', 'png', 'jpeg'];

                        if (in_array($extension, $extensions) && $error == 0 && $size <= 500000) {
                            if (unlink("./img/players/".$joueur['photo'])) {
                                echo "Le fichier a été supprimé avec succès.";
                            } else {
                                echo "Il y a eu une erreur lors de la suppression du fichier.";
                                exit;
                            }
                            $uniqueName = uniqid('', true);
                            $photo = $uniqueName . "." . $extension;
                            move_uploaded_file($tmpName, './img/players/' . $photo);
                        }
                    }

                    $q = $db->prepare("UPDATE joueurs set nom = :nom , prenom = :prenom, photo = :photo, pseudo = :pseudo, date_naissance = :date_naissance, taille = :taille, poids = :poids, statut = :statut, commentaire = :commentaire, poste = :poste WHERE id_Joueur = :id_Joueur");
                    $q->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'photo' => $photo,
                        'pseudo' => $pseudo,
                        'date_naissance' => $date_naissance,
                        'taille' => $taille,
                        'poids' => $poids,
                        'statut' => $statut,
                        'commentaire' => $commentaire,
                        'poste' => $poste,
                        'id_Joueur' => $id
                    ]);

                    header('Location:index.php');
                } else {
                    echo "Ce Joueur existe déjà";
                }
            } else {
                echo "erreur la taille ou le poids ne sont pas valide";
            }
        
        } else {
            echo "Les champ doivent être rempli";
        }
    }
?>
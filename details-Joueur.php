<?php
    require 'includes/header.php';
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
            header("Location:./");
        }
        
    } else {
        header("Location:./");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoL Gestion | Détails Joueur</title>
</head>
<body>
    
</body>
</html>
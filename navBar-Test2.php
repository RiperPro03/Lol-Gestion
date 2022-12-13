<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="navigation">
        <div class="menuDeroulant">
        <ul>
            <li class="liste">
                <a href="#" style="--clr:#f44336;">
                <span class="icone"> </span>
                <span class="texte"> Accueil</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#eec601;">
                <span class="icone"> </span>
                <span class="texte"> Joueur</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#01ee05;">
                <span class="icone"> </span>
                <span class="texte"> Planning</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#01eeea;">
                <span class="icone"> </span>
                <span class="texte"> Creer une équipe</span>
                </a>
            </li>
            <li class="liste">
                <a href="#" style="--clr:#0128ee;">
                <span class="icone"> </span>
                <span class="texte"> Historique des matchs</span>
                </a>
            </li>
        </ul>

        </div>
    </div>
    <script>
        let menuDeroulant = document.querySelector('.menuDeroulant');
        let navigation = document.querySelector('navigation');
        menuDeroulant.onclick =function(){
            navigation.classList.toggle('active');
        }
    </script>
</body>
</html>
<nav class="navigation">
    <div class="menuDeroulant"></div>
    <ul>
        <li class="liste active">
            <a href="./index.php" style="--clr:#f44336;">
                <span class="icone">
                    <div><img src="vue-img.php?img=logo.png" style="width:100%;"></div>
                </span>
                <span class="texte"> Accueil</span>
            </a>
        </li>
        <li class="liste">
            <a href="#" style="--clr:#eec601;">
                <span class="icone">
                    <div><img src="vue-img.php?img=Joueur.png" style="width:100%;"></div>
                </span>
                <span class="texte"> Joueur</span>
            </a>
        </li>
        <li class="liste">
            <a href="#" style="--clr:#01eeea;">
                <span class="icone">
                    <div><img src="vue-img.php?img=Team.png" style="width:100%;"> </div>
                </span>
                <span class="texte"> Equipe</span>
            </a>
        </li>
        <li class="liste">
            <a href="#" style="--clr:#be5fff;">
                <span class="icone">
                    <div><img src="vue-img.php?img=Historique.png" style="width:100%;"></div>
                </span>
                <span class="texte"> Matchs</span>
            </a>
        </li>
        <li class="liste">
            <a href="TEST-accueil.php" style="--clr:#01ee05;">
                <span class="icone">
                    <div><img src="vue-img.php?img=Statistique.png" style="width:100%;"></div>
                </span>
                <span class="texte"> Statistique</span>
            </a>
        </li>
    </ul>
</nav>
<script>
    let menuDeroulant = document.querySelector('.menuDeroulant');
    let navigation = document.querySelector('.navigation');
    menuDeroulant.onclick = function() {
        navigation.classList.toggle('active');
    }

    let list = document.querySelectorAll('.liste');

    function activeLink() {
        list.forEach((item) => item.classList.remove('active'));
        this.classList.add('active');
    }
    list.forEach((item) => item.addEventListener('click', activeLink));

</script>
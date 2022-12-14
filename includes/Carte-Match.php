<?php
    class CarteMatch{
        private $nom;
        private $prefixe;

        function __construct($nom, $prefixe) {
            $this->nom = $nom;
            $this->prefixe = $prefixe;
        }

        function get_nom() {
            return $this->nom;
        }
        
        function get_prefixe() {
            return $this->prefixe;
        }

        function get_carteEquipe(){
            return
            '
            <div class="carteMatch">
                <div class="Equipe">
                    '.
                        $equipe = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe->get_carteEquipe(); 
                    '.
                    <div class=" Versus">
                        <img src="vue-img.php?img=Versus.png" style="width:100%;">
                    </div>
                    '.
                        $equipe = new CarteEquipe('SK Telecom T1','T1');
                        echo $equipe->get_carteEquipe();.'
                </div>
                <div class="contourMatch">
                </div>
                <div class="boiteInfoMatch">
                    <div class="detailsMatch">
                        <h2>Match<br><span> 18/02/2020</span></h2>
                        <h2>Score<br><span> 3 : 1</span></h2>
                        </div>
                    </div>
                </div>
            </div>';
        
        }
    }
?>
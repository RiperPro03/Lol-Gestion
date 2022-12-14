<?php
    class CarteEquipe{
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
            <div class="carteEquipe">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_prefixe().' <br><span>'.$this->get_nom().'</span></h2>
                    </div>
                </div>
            </div>';
        
        }
    }
?>
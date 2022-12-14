<?php
    class CarteEquipe{
        private $nom;
        private $prefixe;

        function __construct($prefixe, $nom) {
            $this->prefixe = $prefixe;
            $this->nom = $nom;
            
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
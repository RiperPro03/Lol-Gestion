<?php
    class CarteEquipe{
        private $nom;
        private $prefixe;

        function __construct( $nom) {
            $this->nom = $nom;
            
        }

        function get_nom() {
            return $this->nom;
        }

        function get_carteEquipe(){
            return
            '
            <div class="carteEquipe">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                </div>
            </div>';
        
        }
    }
?>
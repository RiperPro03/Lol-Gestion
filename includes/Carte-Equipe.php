<?php
    class CarteEquipe{
        private $nom;
        private $idEquipe;

        function __construct( $nom) {
            $this->nom = $nom;
            
        }

        function get_nom() {
            return $this->nom;
        }

        function get_carteEquipeAccueil(){
            return
            '
            <div class="carteEquipe" onclick="location.href=\'./details-Equipe?id='.$this->idEquipe.'\';">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                </div>
            </div>';
        
        }

        function get_carteEquipeAccueilNonClickable(){
            return
            '
            <div class="carteEquipe" id="nonClickable">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                </div>
            </div>';
        
        }

        function get_carteEquipe(){
            return
            '
            <div class="carteEquipe" onclick="location.href=\'./details-Equipe?id='.$this->idEquipe.'\';">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                    <div class="optionEquipe">
                        <a href="modification-Equipe?id='. $this->idEquipe .'" class="boutonEquipe"><i class="fa-solid fa-pen"></i></a>
                        <a href="suppression-Equipe?id='. $this->idEquipe .'" class="boutonEquipe"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>';
        }
        function setIdEquipe($id){
            $this->idEquipe = $id;
        }
    }
?>
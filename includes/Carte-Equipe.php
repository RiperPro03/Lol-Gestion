<?php
    class CarteEquipe{
        private $nom;
        private $idMatch;
        private $isGagnant;

        function __construct( $nom) {
            $this->nom = $nom;
            
        }

        function get_nom() {
            return $this->nom;
        }

        function get_carteEquipeAccueil(){

            $str = '<div class="carteEquipe" onclick="location.href=\'./details-Equipe?id='.$this->idMatch.'\';">';
            if ($this->isGagnant == 1) {
                $str .= '<div class="contourEquipe" id="victoire">';
            } else {
                $str .= '<div class="contourEquipe">';
            }
            return $str .
            '
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                </div>
            </div>';
        
        }

        function get_carteEquipeAccueilNonClickable(){

            $str = '<div class="carteEquipe" id="nonClickable">';
            if ($this->isGagnant == 1) {
                $str .= '<div class="contourEquipe" id="victoire">';
            } else {
                $str .= '<div class="contourEquipe">';
            }
            return $str .
            '
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                </div>
            </div>';
        
        }

        /*function get_carteEquipe(){
            return
            '
            <div class="carteEquipe" onclick="location.href=\'./details-Equipe?id='.$this->idMatch.'\';">
                <div class="contourEquipe">
                </div>
                <div class="boiteInfoEquipe">
                    <div class="detailsEquipe">
                        <h2>'.$this->get_nom().'</h2>
                    </div>
                    <div class="optionEquipe">
                        <a href="modification-Equipe?id='. $this->idMatch .'" class="boutonEquipe"><i class="fa-solid fa-pen"></i></a>
                        <a href="suppression-Equipe?id='. $this->idMatch .'" class="boutonEquipe"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>';
        }*/
        function setIdMatch($id){
            $this->idMatch = $id;
        }

        function isGagnant($isGagnant){
            $this->isGagnant = $isGagnant;
        }
    }
?>
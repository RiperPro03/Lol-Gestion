<?php
    class CarteJoueur{
        private $nom;
        private $prenom;
        private $pseudo;
        private $poste;
        private $image;
        private $victoire;
        private $nbSelection;

        function __construct($nom, $prenom,$pseudo,$poste,$image,$victoire,$nbSelection) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->pseudo = $pseudo;
            $this->poste = $poste;
            $this->image = $image;
            $this->victoire = $victoire; 
            $this->nbSelection = $nbSelection;
        }

        function get_nom() {
            return $this->nom;
        }
        
        function get_prenom() {
            return $this->prenom;
        }
        
        function get_pseudo() {
            return $this->pseudo;
        }
        
        function get_poste() {
            return $this->poste;
        }

        function get_image() {
            return $this->image;
        }
        function get_victoire(){
            return $this->victoire;
        }
        function get_nbSelection(){
            return $this->nbSelection;
        }

        function get_carteJoueurAccueil(){
            return
            '<a href=""><div class="carte">
            <div class="contour">
            </div>
            <div class="boiteimage">
                <div class="image">
                    <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                </div>
                
            </div>
            <div class="boiteInfo">
                <div class="details">
                    <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                    <div class="infoJoueur">
                        <h3> Poste<br> <span>'.$this->get_poste().'</span></h3>
                        <h3> Victoire<br><span>'.$this->get_victoire().'</span></h3>                        
                        <h3> Selection<br><span>'.$this->get_nbSelection().'</span>
                    </div>
                </div>
            </div>
        </div>
        </a>';
        
        }
    }
?>
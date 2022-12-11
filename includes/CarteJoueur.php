<?php
    class CarteJoueur{
        private $nom;
        private $prenom;
        private $pseudo;
        private $poste;
        private $image;
        private $carte;

        function __construct($nom, $prenom,$pseudo,$poste,$image) {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->pseudo = $pseudo;
            $this->poste = $poste;
            $this->image = $image;
            $this->carte = 
            '<div class="carte">
                <div class="infoJoueur">
                    <p>Pseudo : '.$this->get_pseudo().'</p>
                    <p>Nom : '.$this->get_nom().'</p>
                    <p>Prenom : '.$this->get_prenom().'</p>
                    <p>Poste : '.$this->get_poste().'</p>
                </div>
                <div class="CarteImage">
                    <img src="img\players\\'.$this->get_image().'">
                </div>
            </div>';
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

        function get_carteJoueur(){
            return $this->carte;
        }
    }
?>
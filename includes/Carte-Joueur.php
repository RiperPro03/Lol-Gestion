<?php
    class CarteJoueur{
        private $nom;
        private $prenom;
        private $pseudo;
        private $poste;
        private $image;
        private $victoire;
        private $nbSelection;
        private $idJoueur;
        private $idEquipe;

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
            '<div class="carteJoueur" onclick="location.href=\'./details-Joueur?id='.$this->idJoueur.'\';">
            <div class="contourJoueur">
            </div>
            <div class="boiteimageJoueur">
                <div class="imageJoueur">
                    <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                </div>
                
            </div>
            <div class="boiteInfoJoueur">
                <div class="detailsJoueur">
                    <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                    <div class="infoJoueur">
                        <h3> Poste<br> <span>'.$this->get_poste().'</span></h3>
                        <h3> Victoire<br><span>'.$this->get_victoire().'</span></h3>                        
                        <h3> Selection<br><span>'.$this->get_nbSelection().'</span>
                    </div>
                </div>
            </div>
        </div>
        ';
        
        }
        function get_carteJoueurStat(){
            return
            '<div class="carteJoueurDetail onclick="location.href=\'./Statistique?id='.$this->idJoueur.'\';">
                <div class="contourJoueurDetail">
                </div>
                <div class="boiteimageJoueurDetail">
                    <div class="imageJoueurDetail">
                        <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                    </div>
                
                </div>
                <div class="boiteInfoJoueurDetail">
                    <div class="JoueurDetail">
                        <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                    </div>
                </div>
            </div>
            ';
        }

        function get_carteJoueurSelection(){
            return
            '<div class="carteJoueurDetail">
                <div class="contourJoueurDetail">
                </div>
                <div class="boiteimageJoueurDetail">
                    <div class="imageJoueurDetail">
                        <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                    </div>
                
                </div>
                <div class="boiteInfoJoueurDetail">
                    <div class="JoueurDetail">
                        <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                    </div>
                    <div class="optionJoueur">
                            <a href="supprimer-Joueur-Equipe?idJ='. $this->idJoueur .'&idE='. $this->idEquipe .'" class="boutonJoueur"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            ';
        }

        function get_carteJoueur(){
            return
            '<div class="carteJoueur" onclick="location.href=\'./details-Joueur?id='.$this->idJoueur.'\';">
                <div class="contourJoueur">
                </div>
                <div class="boiteimageJoueur">
                    <div class="imageJoueur">
                        <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                    </div>
                
                </div>
                <div class="boiteInfoJoueur">
                    <div class="detailsJoueur">
                        <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                        <div class="infoJoueur">
                            <h3> Poste<br> <span>'.$this->get_poste().'</span></h3>
                            <h3> Victoire<br><span>'.$this->get_victoire().'</span></h3>                        
                            <h3> Selection<br><span>'.$this->get_nbSelection().'</span></h3>
                        </div>
                        <div class="optionJoueur">
                            <a href="modification-Joueur?id='. $this->idJoueur .'" class="boutonJoueur"><i class="fa-solid fa-pen"></i></a>
                            <a href="suppression-Joueur?id='. $this->idJoueur .'" class="boutonJoueur"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            ';
        
        }

        function get_carteJoueurPourDetails(){
            return
            '<div class="carteJoueurDetail" onclick="location.href=\'./details-Joueur?id='.$this->idJoueur.'\';">
                <div class="contourJoueurDetail">
                </div>
                <div class="boiteimageJoueurDetail">
                    <div class="imageJoueurDetail">
                        <img src="vue-img.php?img=' . $this->get_image() . '"style="width:100%;"> 
                    </div>
                
                </div>
                <div class="boiteInfoJoueurDetail">
                    <div class="JoueurDetail">
                        <h2> ' . $this->get_pseudo() . ' <br><span> '.$this->get_prenom().' '.$this->get_nom().'</span></h2>
                    </div>
                    <div class="optionJoueur">
                            <a href="supprimer-Joueur-Equipe?idJ='. $this->idJoueur .'&idE='. $this->idEquipe .'" class="boutonJoueur"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>
            ';
        
        }
        
        function setIdJoueur($id){
            $this->idJoueur = $id;
        }
        function setIdEquipe($id){
            $this->idEquipe = $id;
        }
    }
?>
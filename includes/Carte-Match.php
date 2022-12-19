<?php
    class CarteMatch{
        private $date;
        private $heure;
        private $equipe1; 
        private $equipe2;
        private $score;
        private $idMatch;

        function __construct($date,$heure,$equipe1,$equipe2,$score) {
            $this->date = $date;
            $this->heure = $heure;
            $this->equipe1=$equipe1;
            $this->equipe2=$equipe2;
            $this->score=$score;
        }

        function get_date() {
            return $this->date;
        }
        
        function get_heure() {
            return $this->heure;
        }

        function get_score(){
            if ($this->score != null){
                return $this->score; 
            }else{
                return 'Non renseigné';
            }
        }

        function get_equipe1() {
            return $this->equipe1;
        }

        function get_equipe2() {
            return $this->equipe2;
        }

        function get_carteMatchAccueil(){

            return
            '
            <div class="carteMatch">
                <div class="Equipe">
                    '.$this->equipe1->get_carteEquipeAccueil()
                    .'
                    <div class=" Versus">
                        <img src="vue-img.php?img=Versus.png" style="width:100%;">
                    </div>
                    '.$this->equipe2->get_carteEquipeAccueil().'
                </div>
                <div class="contourMatch">
                </div>
                <div class="boiteInfoMatch">
                    <div class="detailsMatch">
                        <h2>Match<br><span>'. date("d/m/Y", strtotime($this->get_date())).'</span> <span>'.date('H:i', strtotime($this->get_heure())).'</span></h2>
                        <h2>Score<br><span>'. $this->get_score().'</span></h2>
                    </div>
                </div>
            </div>';
        
        }

        function get_carteMatch(){

            return
            '
            <div class="carteMatch">
                <div class="Equipe">
                    '.$this->equipe1->get_carteEquipeAccueil()
                    .'
                    <div class=" Versus">
                        <img src="vue-img.php?img=Versus.png" style="width:100%;">
                    </div>
                    '.$this->equipe2->get_carteEquipeAccueil().'
                </div>
                <div class="contourMatch">
                </div>
                <div class="boiteInfoMatch">
                    <div class="detailsMatch">
                        <h2>Match<br><span>'. date("d/m/Y", strtotime($this->get_date())).'</span> <span>'.date('H:i', strtotime($this->get_heure())).'</span></h2>
                        <h2>Score<br><span>'. $this->get_score().'</span></h2>
                    </div>
                    <div class="optionMatch">
                        <a href="modification-Match?id='. $this->idMatch .'" class="boutonMatch"><i class="fa-solid fa-pen"></i></a>
                        <a href="suppression-Match?id='. $this->idMatch .'" class="boutonMatch"><i class="fa-solid fa-trash"></i></a>
                    </div>
                </div>
            </div>';
        
        }
        function setIdMatch($id){
            $this->idMatch = $id;
        }
    }
?>
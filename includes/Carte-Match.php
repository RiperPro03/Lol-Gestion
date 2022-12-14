<?php
    class CarteMatch{
        private $date;
        private $heure;
        private $equipe1; 
        private $equipe2;
        private $score;

        function __construct($date,$heure,$equipe1,$equipe2,$score) {
            $this->date = $date;
            $this->heure = $heure;
            $this->$equipe1=$equipe1;
            $this->$equipe2=$equipe2;
            $this->$score=$score;
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

        function get_carteMatch(){

            return
            '
            <div class="carteMatch">
                <div class="Equipe">
                    '.
                        $this->equipe1->get_carteEquipe()
                    .'
                    <div class=" Versus">
                        <img src="vue-img.php?img=Versus.png" style="width:100%;">
                    </div>
                    '.$this->equipe2->get_carteEquipe().'
                </div>
                <div class="contourMatch">
                </div>
                <div class="boiteInfoMatch">
                    <div class="detailsMatch">
                        <h2>Match<br><span>'. $this->get_date().'</span> <span>'.$this->get_heure().'</span></h2>
                        <h2>Score<br><span>'. $this->get_score().'</span></h2>
                        </div>
                    </div>
                </div>
            </div>';
        
        }
    }
?>
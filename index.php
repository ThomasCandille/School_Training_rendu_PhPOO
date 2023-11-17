<?php

//Classe Personnage ayant les attributs name et marble

Class Personnage {
    private $name;
    private $marble;

    public function __construct($name, $marble) {
        $this->name = $name;
        $this->marble = $marble;
    }

    //getter

    public function getName() {
        return $this->name;
    }

    public function getMarble() {
        return $this->marble;
    }

    //setter

    public function setName($name) {
        $this->name = $name;
    }

    public function setMarble($marble) {
        $this->marble = $marble;
    }
}

//Classe Heros enfant de Personnage ayant les attributs loss et gain en plus

Class Heros extends Personnage {
    private $loss;
    private $gain;

    public function __construct($name, $marble, $loss, $gain) {
        parent::__construct($name, $marble);
        $this->loss = $loss; //Loss represente le nombre de bille perdu en plus lors d'une defaite
        $this->gain = $gain; //Gain represente le nombre de bille gagné en plus lors d'une victoire
    }

    //getter

    public function getLoss() {
        return $this->loss;
    }

    public function getGain() {
        return $this->gain;
    }

    //Setter

    public function setLoss($loss) {
        $this->loss = $loss;
    }

    public function setGain($gain) {
        $this->gain = $gain;
    }
}

//Classe PNJ enfant de Personnage ayant l'attribut age en plus

Class PNJ extends Personnage {
    private $age;

    public function __construct($name, $marble, $age) {
        parent::__construct($name, $marble);
        $this->age = $age;
    }

    //getter

    public function getAge() {
        return $this->age;
    }

    //setter

    public function setAge($age) {
        $this->age = $age;
    }
}

//Creation d'une liste avec les 3 héros définis par la consigne

$heros = array(
    new Heros("Seong Gi-hun", 15, 2, 1),
    new Heros("Kang Sae-byeok", 25, 1, 2),
    new Heros("Cho Sang-woo", 35, 0, 3)
);

//Creation d'une liste avec 20 pnj aleatoire

$pnj = array(
    new PNJ("Kim Seong-ho", rand(1, 20), rand(18, 100)),
    new PNJ("Oh Il-nam", rand(1, 20), rand(18, 100)),
    new PNJ("Jang Deok-su", rand(1, 20), rand(18, 100)),
    new PNJ("Hwang Jun-ho", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Ji-yeong", rand(1, 20), rand(18, 100)),
    new PNJ("Jung Ho-yeon", rand(1, 20), rand(18, 100)),
    new PNJ("Kim Joo-ryoung", rand(1, 20), rand(18, 100)),
    new PNJ("Kim Su-yeon", rand(1, 20), rand(18, 100)),
    new PNJ("Kim Min-soo", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Dong-hyuk", rand(1, 20), rand(18, 100)),
    new PNJ("Park Hyeon-gyu", rand(1, 20), rand(18, 100)),
    new PNJ("Choi Yeong-su", rand(1, 20), rand(18, 100)),
    new PNJ("Choi Ji-yeong", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-yeon", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-ho", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-hyeon", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-hun", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-hyeok", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-hwan", rand(1, 20), rand(18, 100)),
    new PNJ("Lee Seong-ha", rand(1, 20), rand(18, 100))
);

//Creation d'une liste avec les 3 niveaux de difficulté du jeu (nombre de tour pour difficulté facile -> 5 / moyenne -> 10 / difficile -> 20)

$difficulty = array(
    5, 
    10, 
    20
);

//Creation de la classe Game

Class Game {
    private $difficulty;
    private $heros;
    private $pnj;

    public function __construct($difficulty, $heros, $pnj) {
        $this->difficulty = $difficulty[rand(0, 2)];            //choix de la difficulté entre les 3 valeur (random entre 0 et 2)
        $this->heros = $heros[rand(0, 2)];                      //choix du heros entre les 3 heros dispo (random entre 0 et 2)
        $this->pnj = $pnj;                                      //recuperation de la liste des pnj
    }

    //getter

    public function getDifficulty() {
        return $this->difficulty;
    }

    public function getHeros() {
        return $this->heros;
    }

    public function getPnj() {
        return $this->pnj;
    }

    //debut de la boucle de Jeu

    public function jeu(){

        //explication des conditions de la partie

        echo "Bienvenue dans le jeu du Squid Game ! <br>";
        echo "Vous allez devoir survivre à " . $this->difficulty . "tour <br>";
        echo "Vous avez choisi le personnage " . $this->heros->getName() . "<br>";
        echo "Vous avez " . $this->heros->getMarble() . " billes <br>";

        //debut de la boucle de jeu

        for ($i = 0; $i < $this->difficulty; $i++) {

            //affichage du tour / nombre de bille
            echo "<br>";    
            echo "Tour " . ($i + 1) . "<br>";

            echo "Vous avez " . $this->heros->getMarble() . " billes <br>";

            //choix de l'ennemi
            
            $ennemi = $this->pnj[rand(0, 19)];

            //choix de pair ou impair pour le nombre de bille dans la main de l'adversaire

            $guess = ["pair", "impair"][rand(0, 1)];

            //verification de pair ou impair dans la main de l'adversaire

            $result = $ennemi->getMarble() % 2 == 0 ? "pair" : "impair";

            //Condition pour verifier si il est possible de tricher contre l'ennemi ou non

            if($ennemi->getAge() > 70){

                echo "L'ennemi " . $ennemi->getName() . " a " . $ennemi->getAge() . " et il est vieux, veux tu tricher pour le duper  <br>";

                //Une chance sur deux detricher

                $triche = rand(0, 1);

                //Si le joueur choisit de tricher

                if($triche == 1){

                    //la valeur de guess devient la valeur de result (guess devient obligatoirement le bon nombre de bille)
                    echo "Vous décidez de tricher, c'est pas bien ! <br>";
                    $guess = $result;

                    echo "Vous savez que" . $ennemi->getName() . " a un nombre " . $guess . " de billes <br>";
                }

                else{

                    //Si le joueur ne triche pas, il ne se passe erien en plus

                    echo "Vous n'avez pas triché, vous etes un bon ! <br>";

                    echo "Vous pensez que le nombre de marble de " . $ennemi->getName() . " est " . $guess . "<br>";
                }
            }

            else{

                //si le joueur n'est pas vieux, rien ne se passe

                echo "Vous pensez que le nombre de marble de " . $ennemi->getName() . " est " . $guess . "<br>";
            }

            //Si le joueur guess est bon

            if($result == $guess){

                //affichage du nombre de bille de l'ennemi

                echo "L'ennemi " . $ennemi->getName() . " avait dans sa main " . $ennemi->getMarble() . " billes <br>";

                echo "Vous remportez la rencontre ! <br>";

                //ajout des billes gagnés au nombre de bille total du joueur

                $gagner = $ennemi->getMarble() + $this->heros->getGain();   // nb bille de l'ennemi + bonnus de gain

                echo "Vous avez gagné " . $gagner . " billes <br>";

                $this->heros->setMarble($this->heros->getMarble() + $gagner);   //attribution des gains

                echo "Vous avez maintenant " . $this->heros->getMarble() . " billes <br>";
            }

            else{

                //affichage du nombre de bille de l'ennemi

                echo "Vous avez perdu :( <br>" . $ennemi->getName() . " avait dans sa main " . $ennemi->getMarble() . " billes <br>";

                $perdu = $ennemi->getMarble() + $this->heros->getLoss();    //nb bille de l'ennemi + malus de perte

                //suppression des billes perdues au nombre de bille total du joueurx    

                echo "Vous avez perdu " . $perdu . " billes <br>";

                $this->heros->setMarble($this->heros->getMarble() - $perdu);    //attribution du nombre de bille perdu 

                //si le nombre de bille (apres soustaction des pertes) est supérieur à 0

                if($this->heros->getMarble() > 0){

                    //affichage du nombre de bille restant

                    echo "Vous avez maintenant " . $this->heros->getMarble() . " billes <br>";
                }
    
                else{

                    //si le heros n'a plus de bille, affichage de la defaite

                    echo "Vous avez perdu toute vos billes <br>";
                }
            }

            if($this->heros->getMarble() <= 0){

                //si le heros n'a plus de bille, fin de la partie

                echo "Vous avez perdu la partie :(  <br>";
                break;
            }

            if($i == $this->difficulty - 1){

                //si tous les tours ont été joués
                
                echo "Vous avez gagné la partie ! <br>";
            }
        }
    }
}

$game = new Game($difficulty, $heros, $pnj);
$game->jeu();


?>
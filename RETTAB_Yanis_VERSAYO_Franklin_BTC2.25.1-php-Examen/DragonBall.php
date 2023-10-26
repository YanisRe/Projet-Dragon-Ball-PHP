<?php

class Personnage{

    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;
    private boolval $est_vilain;


    public function __construct($nom, $vie, $puissance_attaque){
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;
    }

    public function getNom(){
        return $this->nom;
    }

    public function getVie(){
        return $this->vie;
    }

    public function getPuissance_attaque(){
        return $this->puissance_attaque;
    }

    public function getDegats_subis(){
        return $this->degats_subis;
    }

    public function setNom($nom){
        $this->nom = $nom;
    }

    public function attaque($adversaire){
        $adversaire->vie -= $this->puissance_attaque;
    }

    public function prendre_degats($degats_subis){
        $this->vie -= $degats_subis;
    }

    public function est_vivant(){
        if($this->vie > 0){
            echo "Il te reste ".$this->vie." points de vie.";
            return true;
        }else{
            return false;
        }
    }

    public function est_mort(){
        if($this->vie <= 0){
            echo "Tu es mort.";
            return true;
        }
        else{
            return est_vivant();
        }
    }

    public function choixCamp(){

        if($this->est_vilain = $true){

        }
        else{
            $adversaire = $vilain($i);
        }

        $this->est_vilain = $false;
        echo "Veuillez choisir votre camp : h pour héros ou v pour vilain." . PHP_EOL;
        $choix = readline();
        
        if($choix === "h"){
            $this->est_vilain = false;
            echo "Veuillez entrer le nom de votre personnage." . PHP_EOL;
            $nom = readline();
            $hero = new Heros($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            echo "Vous avez choisi le camp des héros !" . PHP_EOL;
            return $hero($i);
        }
        else if ($choix === "v"){
            $this->est_vilain = true;
            $adversaire = $hero($i);
            echo "Veuillez entrer le nom de votre personnage." . PHP_EOL;
            $nom = readline();
            $vilain = new Vilains($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            echo "Vous avez choisi le camp des vilains !" . PHP_EOL;
            return $vilain($i);
        }
        else{
            echo "Veuillez choisir un camp valide." . PHP_EOL;
            choixCamp();
        }
        affectationEnnemi();
    }
}



class Heros extends Personnage{
    
    protected boolval $est_vilain;
    $vilain;
    $adversaire;
    $nom;
    $vie = 400;
    $puissance_attaque = 20;
    $degats_subis;

    $hero1 = new Heros("Goku", 100, 20, 10, $vilain($i));
    $hero2 = new Heros("Vegeta", 100, 20, 10, $vilain($i));
    $hero3 = new Heros("Gohan", 100, 20, 10, $vilain($i));
    $hero4 = new Heros("Trunks", 100, 20, 10, $vilain($i));
    $hero5 = new Heros("Goten", 100, 20, 10, $vilain($i));
    $hero6 = new Heros("Piccolo", 100, 20, 10, $vilain($i));
    $hero7 = new Heros("Krilin", 100, 20, 10, $vilain($i));
    $hero8 = new Heros("C-18", 100, 20, 10, $vilain($i));
    $hero9 = new Heros("Tenshinhan", 100, 20, 10, $vilain($i));
    $hero10 = new Heros("C-17", 100, 20, 10, $vilain($i));



    protected $hero = [$hero1, $hero2, $hero3, $hero4, $hero5, $hero6, $hero7, $hero8, $hero9, $hero10];

    
    
    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain);
        $this->est_vilain = false;
    }

    public function affectationEnnemi(){

        $vilain = [$vilain1, $vilain2, $vilain3, $vilain4, $vilain5, $vilain6, $vilain7, $vilain8, $vilain9, $vilain10];
        $random = rand(0, 9);
        $this->adversaire = $vilain[$random];

        $this->prendre_degats($this->adversaire->puissance_attaque);
        $this->adversaire->prendre_degats($this->puissance_attaque);
        
    }   
}



class Vilains extends Personnage{
    
    boolval $est_vilain;
    $adversaire;
    $nom;
    $vie = 480;
    $puissance_attaque = 10;
    $degats_subis;

    $vilain1 = new Vilains("Radditz", 100, 20, 10, $hero($i));
    $vilain2 = new Vilains("Freezer", 100, 20, 10, $hero($i));
    $vilain3 = new Vilains("Cell", 100, 20, 10, $hero($i));
    $vilain4 = new Vilains("Janemba", 100, 20, 10, $hero($i));
    $vilain5 = new Vilains("Buu", 100, 20, 10, $hero($i));
    $vilain6 = new Vilains("Dr. Gero", 100, 20, 10, $hero($i));
    $vilain7 = new Vilains("Zamasu", 100, 20, 10, $hero($i));
    $vilain8 = new Vilains("Cell Jr.", 100, 20, 10, $hero($i));
    $vilain9 = new Vilains("Saibaiman", 100, 20, 10, $hero($i));
    $vilain10 = new Vilains("Li Shenron", 100, 20, 10, $hero($i));

    protected $vilain = [$vilain1, $vilain2, $vilain3, $vilain4, $vilain5, $vilain6, $vilain7, $vilain8, $vilain9, $vilain10];

    
    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain);
        $this->est_vilain = true;
    }
    
    public function affectationEnnemi(){

        $hero = [$hero1, $hero2, $hero3, $hero4, $hero5, $hero6, $hero7, $hero8, $hero9, $hero10];
        $random = rand(0, 9);
        $this->adversaire = $hero[$random];

        $this->prendre_degats($this->adversaire->puissance_attaque);
        $this->adversaire->prendre_degats($this->puissance_attaque);
        
    } 
    
}

class combat extends Personnage{
    
    protected $adversaire;
    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;


    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
    }

    public function enJeu(){
            
        echo "Veuillez choisir une action : c pour combattre ou q pour quitter." . PHP_EOL;
        
        $action = readline();
        switch ($action){
            case "c":
                while($this->vie > 0 && $this->adversaire->vie > 0){
                    
                    est_mort();

                    echo "Veuillez choisir une action : a pour attaquer, t pour transformation, et f pour essayer de prendre la fuite." . PHP_EOL;
                    $decision = readline();
                    switch ($decision){
                        case "a":
                            echo "Vous avez choisi d'attaquer." . PHP_EOL . "Veuillez choisir entre une attaque normale (n) ou une attaque spéciale (s)." . PHP_EOL;
                            $attaque = readline();
                            switch ($attaque){
                                case "n":
                                    echo "Vous avez choisi l'option attaque normale." . PHP_EOL;
                                    $this->attaque($this->adversaire);
                                    //
                                    break;
                                case "s":
                                    echo "Vous avez choisi l'option attaque spéciale." . PHP_EOL;
                                    $attaque_speciale = readline();
                                    switch ($attaque_speciale){
                                        case 1:
                                            echo "Vous avez choisi l'attaque spéciale Kienzan." . PHP_EOL;
                                            $this->attaque($this->adversaire);
                                            //
                                            break;
                                        case 2:
                                            echo "Vous avez choisi l'attaque spéciale Kamehameha." . PHP_EOL;
                                            $this->attaque($this->adversaire);
                                            //
                                            break;
                                        case 3:
                                            echo "Vous avez choisi l'attaque spéciale Genkidama." . PHP_EOL;
                                            $this->attaque($this->adversaire);
                                            //
                                            break;
                                    //
                                    break;
                                    $adversaire->choiceAboutActions();
                            }
                            break;
                        }
                    break;
                    //
            case "q":
                echo "Vous avez quitté le jeu.";
                exit();
            default:
                echo "Veuillez choisir une action valide." . PHP_EOL;
                enJeu();
                break;
        //endswitch;
                }
        }
    }        //est_vivant();
        
    }

    public function systeme_de_combat(){
        $this->adversaire = $adversaire;
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;
        $this->degats_subis = $degats_subis;
        $this->adversaire = $adversaire;


        //menu();
        //synopsis(); if play puis choixCamp();

        choixCamp();
        enJeu();
        
    }
}


class IA extends Personnage{

    protected $adversaire;
    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;

    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
        $this->est_vilain = $est_vilain;
    }

    public function logiqueEnnemi(){
        if($this->est_vilain == true){
            $hero = new Heros($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            $this->adversaire = $hero;
        }
        else{
            $vilain = new Vilains($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            $this->adversaire = $vilain;
        }
    }

    public function logiqueCombat(){
        while($this->vie > 0 && $this->adversaire->vie > 0){
                        
            $this->attaque($this->adversaire);
            $this->adversaire->attaque($this);

            $this->attaque($this->adversaire) == $this->prendre_degats($this->degats_subis);
            $this->adversaire->attaque($this) == $this->adversaire->prendre_degats($this->degats_subis);

            est_mort();
        }
    }

    public function choiceAboutActions(){
        $random = rand(0, 2);
        $action = [$attaque, $transformation, $fuite];
        $choixFinal = $action[$random];
        return "$nom a choisi l'option $choixFinal";
    }
}

// class Jeu extends combat{
    
//         private $adversaire;
//         private $nom;
//         private $vie;
//         private $puissance_attaque;
//         private $degats_subis;
//         private $est_vilain;
//         private $est_heros;
    
//         public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain, $est_heros){
//             parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
//             $this->est_vilain = $est_vilain;
//             $this->est_heros = $est_heros;
//         }
    
//         public function systeme_de_jeu(){
//             $this->adversaire = $adversaire;
//             $this->nom = $nom;
//             $this->vie = $vie;
//             $this->puissance_attaque = $puissance_attaque;
//             $this->degats_subis = $degats_subis;
//             $this->adversaire = $adversaire;
//             $this->est_vilain = $est_vilain;
//             $this->est_heros = $est_heros;

//         }
// }

?>
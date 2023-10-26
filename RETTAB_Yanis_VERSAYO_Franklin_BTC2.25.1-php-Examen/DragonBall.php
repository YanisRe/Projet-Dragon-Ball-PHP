<?php

class Personnage{

    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;

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
        echo "Veuillez choisir votre camp : h pour héros ou v pour vilain." . PHP_EOL;
        $choix = readline();
        
        if($choix === "h"){
            $this->est_vilain = false;
            for($i=0; $i</*Taille de la base d'ennemis*/; $i++){
                $hero($i)= new Heros($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            }
        }
        else if ($choix === "v"){
            $this->est_vilain = true;
            for($i=0; $i</*Taille de la base d'ennemis*/; $i++){
                $vilain($i)= new Vilains($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            }
        }
        else{
            echo "Veuillez choisir un camp valide." . PHP_EOL;
            choixCamp();
        }
    }
    //Boucle permettant de créer un perso avec une variable $i+1
}
class combat{
    
}
class Heros extends Personnage{
    
    private $adversaire;
    private $nom;
    private $vie;
    private $puissance_attaque;
    private $degats_subis;
    
    
    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
    }
    
}

class Vilains extends Personnage{
    
    private $adversaire;
    private $nom;
    private $vie;
    private $puissance_attaque;
    private $degats_subis;
    
    
    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
    }
    
    //$vilain1 = new Vilains("Freezer", 100, 20, 10, $hero($i));
}

class combat extends Personnage{
    
    private $adversaire;
    private $nom;
    private $vie;
    private $puissance_attaque;
    private $degats_subis;


    public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire){
        parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
    }

    public function systeme_de_combat(){
        $this->adversaire = $adversaire;
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;
        $this->degats_subis = $degats_subis;
        $this->adversaire = $adversaire;

        while($this->vie > 0 && $this->adversaire->vie > 0){
                        
            $this->attaque($this->adversaire);
            $this->adversaire->attaque($this);

            $this->attaque($this->adversaire) = $this->prendre_degats($this->degats_subis);
            $this->adversaire->attaque($this) = $this->adversaire->prendre_degats($this->degats_subis);

            est_mort();


            //est_vivant();
            
        }
    }
}


class IA extends Personnage{

    private $adversaire;
    private $nom;
    private $vie;
    private $puissance_attaque;
    private $degats_subis;
    private boolval $est_vilain;


}

class Jeu extends combat{
    
        private $adversaire;
        private $nom;
        private $vie;
        private $puissance_attaque;
        private $degats_subis;
        private $est_vilain;
        private $est_heros;
    
        public function __construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire, $est_vilain, $est_heros){
            parent::__construct($nom, $vie, $puissance_attaque, $degats_subis, $adversaire);
            $this->est_vilain = $est_vilain;
            $this->est_heros = $est_heros;
        }
    
        public function systeme_de_jeu(){
            $this->adversaire = $adversaire;
            $this->nom = $nom;
            $this->vie = $vie;
            $this->puissance_attaque = $puissance_attaque;
            $this->degats_subis = $degats_subis;
            $this->adversaire = $adversaire;
            $this->est_vilain = $est_vilain;
            $this->est_heros = $est_heros;
    
            if($this->est_vilain == true){
                $this->systeme_de_combat();
            }else{
                $this->systeme_de_combat();
            }
        }
}

?>
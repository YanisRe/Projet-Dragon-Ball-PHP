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
}
class combat{

<<<<<<< HEAD
}
=======

>>>>>>> 26739d71d7329a809871c305d480d569aa939092
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

}


?>
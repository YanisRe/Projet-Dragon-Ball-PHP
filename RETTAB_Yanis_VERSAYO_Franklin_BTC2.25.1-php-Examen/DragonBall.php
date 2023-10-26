<?php

class Personnage{

    protected $nom;
    protected $vie;
    protected $puissance_attaque;

    public function __construct($nom, $vie, $puissance_attaque){
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;

    }
}

class Heros extends Personnage{

    public function __construct($nom, $vie, $puissance_attaque){
        parent::__construct($nom, $vie, $puissance_attaque);
    }
    
}

class Vilains extends Personnage{
    
    public function __construct($nom, $vie, $puissance_attaque){
        parent::__construct($nom, $vie, $puissance_attaque);
    }
}


?>
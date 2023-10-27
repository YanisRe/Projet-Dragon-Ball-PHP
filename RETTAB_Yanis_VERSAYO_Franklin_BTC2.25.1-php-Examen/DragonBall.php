<?php
//On crée notre classe personnage dans laquelle on stocke les informations concrnant les personnages du jeu
class Personnage {
    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;
    protected $est_vilain;
    protected $inventaire;

    public function __construct($nom, $vie, $puissance_attaque, $est_vilain = false) {
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;
        $this->degats_subis = 0;
        $this->est_vilain = $est_vilain;
        $this->inventaire = [];
    }
    //on ajoute un systeme pour pouvoir prendre des degats et en infliger
    public function prendreDegats($degats) {
        $this->degats_subis += $degats;
        $this->vie -= $degats;
        //on ajoute un systeme pour que la vie ne puisse pas devenir negativ 
        if ($this->vie <= 0) {
            $this->vie = 0;
        }
    }

    public function getPersonnageData() {
        return [
            'nom' => $this->nom,
            'vie' => $this->vie,
            'puissance_attaque' => $this->puissance_attaque,
            'degats_subis' => $this->degats_subis,
            'est_vilain' => $this->est_vilain,
            'inventaire' => $this->inventaire,
        ];
    }
    
    public function getNom() {
        return $this->nom;
    }

    public function getVie() {
        return $this->vie;
    }

    public function getPuissance_attaque() {
        return $this->puissance_attaque;
    }

    public function getDegats_subis() {
        return $this->degats_subis;
    }

    public function attaque($adversaire) {
        $adversaire->prendreDegats($this->puissance_attaque);
    }
    //on cree ici une fonction pour gerer les stats de nos persos
    public function getPlayerStats() {
        echo "Statistiques du joueur : " . PHP_EOL;
        echo "Nom : " . $this->getNom() . PHP_EOL;
        echo "Points de vie : " . $this->getVie() . PHP_EOL;
        echo "Puissance d'attaque : " . $this->getPuissance_attaque() . PHP_EOL;
        if (!empty($this->inventaire)) {
            echo "Inventaire : " . implode(", ", $this->inventaire) . PHP_EOL;
        }
    }

    public function estVivant() {
        return $this->vie > 0;
    }

    public function estMort() {
        return $this->vie <= 0;
    }

    public function ajouterInventaire($objet) {
        $this->inventaire[] = $objet;
    }
    //on ajoute un bonus pour pouvoir utiliser des items dans notre jeu, 
    public function utiliserObjet($objet) {
        if (in_array($objet, $this->inventaire)) {
            if ($objet === "Senzu") {
                $this->vie += 20;
                echo $this->nom . " a utilisé un haricot magique et a récupéré 20 points de vie." . PHP_EOL;
            }
            $index = array_search($objet, $this->inventaire);
            if ($index !== false) {
                unset($this->inventaire[$index]);
            }
        } else {
            echo $this->nom . " n'a pas cet objet dans son inventaire." . PHP_EOL;
        }
    }
}
//on cree une classe heros enfant de la classe personnage
class Heros extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 300, 20);
    }

    public function estVivant() {
        return $this->vie > 0;
    }

    public function setPersonnageData($data) {
        $this->nom = $data['nom'];
        $this->vie = $data['vie'];
        $this->puissance_attaque = $data['puissance_attaque'];
        $this->degats_subis = $data['degats_subis'];
        $this->est_vilain = $data['est_vilain'];
        //$this->inventaire = $data['inventaire'];
    }
    
//On ajoute une fonctionnalite d'attaque speciale kamehameha
    public function attaqueSpeciale($adversaire) {
        if ($this->vie >= 30) {
            $this->vie -= 30;
            $adversaire->prendreDegats(40);
            echo $this->nom . " a lancé l'attaque spéciale Kamehameha!" . PHP_EOL;
        } else {
            echo $this->nom . " n'a pas suffisamment de vie pour utiliser l'attaque spéciale." . PHP_EOL;
        }
    }
}
//on cree une class vilain enfant de la classe personnage
class Vilains extends Personnage {
    public function __construct($nom) {
        parent::__construct($nom, 100, 20, true);
    }

    public function estVivant() {
        return $this->vie > 0;
    }

    public function setPersonnageData($data) {
        $this->nom = $data['nom'];
        $this->vie = $data['vie'];
        $this->puissance_attaque = $data['puissance_attaque'];
        $this->degats_subis = $data['degats_subis'];
        $this->est_vilain = $data['est_vilain'];
        $this->inventaire = $data['inventaire'];
    }
    //ici pareil que pour les heros, fonctionnalite d'attaque special
    public function attaqueSpeciale($adversaire) {
        if ($this->vie >= 20) {
            $this->vie -= 20;
            $adversaire->prendreDegats(30);
            echo $this->nom . " a lancé l'attaque spéciale Vilain!" . PHP_EOL;
        } else {
            echo $this->nom . " n'a pas suffisamment de vie pour utiliser l'attaque spéciale." . PHP_EOL;
        }
    }
}
//le systeme de combat, qui va gerer tout ce qui touche au combat
class Combat {
    
    public function afficherStatistiques($personnage) {
        echo $personnage->getNom() . " - Points de vie : " . $personnage->getVie() . " - Puissance d'attaque : " . $personnage->getPuissance_attaque() . PHP_EOL;
    }
    //on affiche les resultats des combats une fois finis
    public function afficherResultatCombat($heros, $vilain) {
        if ($heros->estMort()) {
            echo $heros->getNom() . " a été vaincu par " . $vilain->getNom() . "!" . PHP_EOL;
        } elseif ($vilain->estMort()) {
            echo $vilain->getNom() . " a été vaincu par " . $heros->getNom() . "!" . PHP_EOL;
        }
    }
    //on cree un systeme pour gerer les combats,donner des action au joueur
    public function combat($heros, $vilain) {
        while ($heros->estVivant() && $vilain->estVivant()) {
            $this->afficherStatistiques($heros);
            $this->afficherStatistiques($vilain);

            echo "Actions possibles : (1) Attaque normale, (2) Attaque spéciale, (3) Utiliser objet, (4) Fuir" . PHP_EOL;
            $action = readline("Choisissez une action (1/2/3/4) : ");
            //apres avoir demander au joueur ce quil veut faire on creer le systeme pour gerer les actions
            switch ($action) {
                case "1":
                    $heros->attaque($vilain);
                    echo $heros->getNom() . " a attaqué " . $vilain->getNom() . " avec une attaque normale!" . PHP_EOL;
                    break;
                case "2":
                    $heros->attaqueSpeciale($vilain);
                    break;
                // case "3":
                //     echo "Inventaire de " . $heros->getNom() . ": " . implode(", ", $heros->inventaire) . PHP_EOL;
                //     $objet = readline("Choisissez un objet de l'inventaire : ");
                //     $heros->utiliserObjet($objet);
                //     break;
                case "4":
                    echo $heros->getNom() . " a fui le combat." . PHP_EOL;
                    return;
                default:
                    echo "Action non valide." . PHP_EOL;
                    break;
            }

            if ($vilain->estVivant()) {
                $vilain->attaque($heros);
                echo $vilain->getNom() . " a attaqué " . $heros->getNom() . " avec une attaque normale!" . PHP_EOL;
            }
            $this->afficherStatistiques($vilain);
        }
        //puis on affiche les resultats du combat
        $this->afficherResultatCombat($heros, $vilain);
        if ($heros->estVivant()) {
            $heros->prendreDegats(-10);
            echo $heros->getNom() . " a débloqué une nouvelle attaque : Kamehameha!" . PHP_EOL;
        }
    }
}

//on creer une class qui servira a gerer les sauvegardes
class DragonBallGame {
    private $filename;
    private $player;
    private $defeatedEnemies = [];

    public function __construct($filename, $player) {
        $this->filename = $filename;
        $this->player = $player;
    }
    //on relit le fichier de sauvegarde pour reprendre ou le joueur etait
    public function loadGameState() {
        if (file_exists($this->filename)) {
            $gameStateJSON = file_get_contents($this->filename);
            $gameState = json_decode($gameStateJSON, true);
    
            
            $playerData = $gameState['player'];
            if ($playerData['est_vilain']) {
                $player = new Vilains($playerData['nom']);
            } else {
                $player = new Heros($playerData['nom']);
            }
    
            $player->setPersonnageData($playerData);
    
            $this->player = $player;
            $this->defeatedEnemies = $gameState['defeatedEnemies'];
    
            echo "Chargement de la sauvegarde effectué." . PHP_EOL;
        }
        else {
            echo "Aucune sauvegarde trouvée." . PHP_EOL;
            //on precise quand sa echoue
        }
    }
    
    //on ecrit dans un fichier externe les donnees du joueur, qu'on lira lors du chargement de la sauvegarde
    public function saveGameState($player) {
    $gameState = [
        'player' => [
            'nom' => $player->getNom(),
            'vie' => $player->getVie(),
            'puissance_attaque' => $player->getPuissance_attaque(),
            'degats_subis' => $player->getDegats_subis(),
            'est_vilain' => $player instanceof Vilains,
            //'inventaire' => $player->inventaire,
        ],
        'defeatedEnemies' => $this->defeatedEnemies,
    ];
    //on indique au joueur que la sauvegarde a bien ete effectue
    $gameStateJSON = json_encode($gameState);
    file_put_contents($this->filename, $gameStateJSON);
    echo "Sauvegarde effectuée avec succès." . PHP_EOL;
}
//on propose au joueur de supprimer sa sauvegarde si il le souhaite
public function delGameState() {
    if (file_exists($this->filename)) {
        unlink($this->filename);
        echo "Sauvegarde supprimée avec succès." . PHP_EOL;
    } else {
        echo "Aucune sauvegarde trouvée à supprimer." . PHP_EOL;
    }
    //sinon on lui indique qu'il n'y a pas de sauvegarde qui a etee trouvee

}
    
    //on recupere les stats du joueur
    public function getPlayerStats() {
        if ($this->player !== null && $this->player instanceof Personnage) {
            $this->player->getPlayerStats();
        } else {
            echo "Aucun joueur n'a été chargé." . PHP_EOL;
        }
    }

    public function setPlayer($player) {
        $this->player = $player;
    }

    public function addDefeatedEnemy($enemyName) {
        $this->defeatedEnemies[] = $enemyName;
    }

    public function getDefeatedEnemies() {
        return $this->defeatedEnemies;
    }

    public function getPlayer() {
        return $this->player;
    }
}



$game = new DragonBallGame('dragon_ball_save.json', null);

//on cree ici le menu principal du jeu, sur lequel on aura l'intégralité des actions dispo 
//le tout dans une boucle pour éviter que le jeu se ferme après chaque choix

while (true) {
    echo "MENU :" . PHP_EOL;
    echo "1. Lancer une nouvelle partie" . PHP_EOL;
    echo "2. Charger une partie" . PHP_EOL;
    echo "3. Statistiques des ennemis tués" . PHP_EOL;
    echo "4. Quitter" . PHP_EOL;

    $choix = readline("Faites votre choix (1/2/3/4) : ");

    //on demande ce que le joueur souhaite faire

    switch ($choix) {
        case '1':
            $i = 1;
            $game->delGameState();
            
            //on demande au joueur si il souhaite etre vilain ou heros

            echo "Choisissez un camp : (H) Héros ou (V) Vilain" . PHP_EOL;
            $choixCamp = strtolower(readline("Entrez votre choix (H/V) : "));
            
            //on rend la réponse du joueur insensible à la casse avec le string to lower

            if ($choixCamp === 'h' || $choixCamp === 'H') {
                
                $nom = readline("Entrez le nom de votre personnage : ");
                $player = new Heros($nom);
                echo "Vous avez créé un héros nommé $nom." . PHP_EOL;
            } elseif ($choixCamp === 'v') {
                
                $nom = readline("Entrez le nom de votre personnage : ");
                $player = new Vilains($nom);
                echo "Vous avez créé un vilain nommé $nom." . PHP_EOL;
            } else {
                echo "Camp non valide. Choisissez h pour héros ou v pour vilain." . PHP_EOL;
                break;
            }
        
            
            $game = new DragonBallGame('dragon_ball_save.json', $player);
            $game->loadGameState(); 

        
            
            $game = new DragonBallGame('dragon_ball_save.json', $player);
            $game->loadGameState(); 
        
            //la liste des persos mechant dispo dans le jeu
            $availableVilains = [
                new Vilains("Freezer"),
                new Vilains("Cell"),
                new Vilains("Majin Buu"),
                new Vilains("Raditz"),
            ];
            $vilain = $availableVilains[array_rand($availableVilains)];
        
            $combat = new Combat();
            $combat->combat($player, $vilain);
        
            $game->addDefeatedEnemy($vilain->getNom());
            $game->saveGameState($player);
        
            $game->getPlayerStats($player);
            $i += 1;
        
            break;
            
            case '2':
            
                $game->loadGameState();
                $player = $game->getPlayer();
            
                if ($player !== null) {
                    echo "Partie chargée." . PHP_EOL;
            
                    $vilain = new Vilains("Raditz");
            
                    $combat = new Combat();
                    $combat->combat($player, $vilain);
            
                    $game->addDefeatedEnemy($vilain->getNom());
                    $game->saveGameState($player);
            
                    $game->getPlayerStats($player);
                } else {
                    echo "Aucune partie sauvegardée trouvée." . PHP_EOL;
                }
                break;
            
                case '3':
                    $i = 1;
            
            $defeatedEnemies = $game->getDefeatedEnemies();
            if (!empty($defeatedEnemies)) {
                echo "Statistiques des ennemis tués :" . PHP_EOL;
                foreach ($defeatedEnemies as $enemy) {
                    echo "Combat n°$i - $enemy" . PHP_EOL;
                }
            } else {
                echo "Aucun ennemi vaincu pour le moment." . PHP_EOL;
            }
            break;


            case '4':
                // Règles du jeu
                echo ""
                break;
        case '5':
            //
            exit();
            break;

        default:
            echo "Choix non valide. Veuillez choisir une option valide (1/2/3/4/5)." . PHP_EOL;
            break;
    }
}
?>
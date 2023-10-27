<?php

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

    public function prendreDegats($degats) {
        $this->degats_subis += $degats;
        $this->vie -= $degats;
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

    public function utiliserObjet($objet) {
        if (in_array($objet, $this->inventaire)) {
            if ($objet === "potion") {
                $this->vie += 20;
                echo $this->nom . " a utilisé une potion et a récupéré 20 points de vie." . PHP_EOL;
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

class Combat {
    
    public function afficherStatistiques($personnage) {
        echo $personnage->getNom() . " - Points de vie : " . $personnage->getVie() . " - Puissance d'attaque : " . $personnage->getPuissance_attaque() . PHP_EOL;
    }

    public function afficherResultatCombat($heros, $vilain) {
        if ($heros->estMort()) {
            echo $heros->getNom() . " a été vaincu par " . $vilain->getNom() . "!" . PHP_EOL;
        } elseif ($vilain->estMort()) {
            echo $vilain->getNom() . " a été vaincu par " . $heros->getNom() . "!" . PHP_EOL;
        }
    }

    public function combat($heros, $vilain) {
        while ($heros->estVivant() && $vilain->estVivant()) {
            $this->afficherStatistiques($heros);
            $this->afficherStatistiques($vilain);

            echo "Actions possibles : (1) Attaque normale, (2) Attaque spéciale, (3) Utiliser objet, (4) Fuir" . PHP_EOL;
            $action = readline("Choisissez une action (1/2/3/4) : ");

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

        $this->afficherResultatCombat($heros, $vilain);
        if ($heros->estVivant()) {
            $heros->prendreDegats(-10);
            echo $heros->getNom() . " a débloqué une nouvelle attaque : Kamehameha!" . PHP_EOL;
        }
    }
}


class DragonBallGame {
    private $filename;
    private $player;
    private $defeatedEnemies = [];

    public function __construct($filename, $player) {
        $this->filename = $filename;
        $this->player = $player;
    }

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
        }
    }
    

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

    $gameStateJSON = json_encode($gameState);
    file_put_contents($this->filename, $gameStateJSON);
    echo "Sauvegarde effectuée avec succès." . PHP_EOL;
}

public function delGameState() {
    if (file_exists($this->filename)) {
        unlink($this->filename);
        echo "Sauvegarde supprimée avec succès." . PHP_EOL;
    } else {
        echo "Aucune sauvegarde trouvée à supprimer." . PHP_EOL;
    }
}
    

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

while (true) {
    echo "MENU :" . PHP_EOL;
    echo "1. Lancer une nouvelle partie" . PHP_EOL;
    echo "2. Charger une partie" . PHP_EOL;
    echo "3. Statistiques des ennemis tués" . PHP_EOL;
    echo "4. Quitter" . PHP_EOL;

    $choix = readline("Faites votre choix (1/2/3/4) : ");

    switch ($choix) {
        case '1':
            $i = 1;
            $game->delGameState();
        

            echo "Choisissez un camp : (H) Héros ou (V) Vilain" . PHP_EOL;
            $choixCamp = strtolower(readline("Entrez votre choix (H/V) : "));
            
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
            $game->loadGameState(); // Charge l'état du jeu au démarrage

        
            
            $game = new DragonBallGame('dragon_ball_save.json', $player);
            $game->loadGameState(); // Charge l'état du jeu au démarrage
        
            
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


            // case '4':
            //     // Règles du jeu
            //     echo ""
            //     break;
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
// Path: RETTAB_Yanis_VERSAYO_Franklin_BTC2.25.1-php-Examen/README.md
<?php

class Personnage {
    protected $nom;
    protected $vie;
    protected $puissance_attaque;
    protected $degats_subis;
    protected $est_vilain;

    public function __construct($nom, $vie, $puissance_attaque, $est_vilain = false) {
        $this->nom = $nom;
        $this->vie = $vie;
        $this->puissance_attaque = $puissance_attaque;
        $this->degats_subis = 0;
        $this->est_vilain = $est_vilain;
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
    }

    public function estVivant() {
        return $this->vie > 0;
    }

    public function estMort() {
        return $this->vie <= 0;
    }

}

class Heros extends Personnage {
    protected $victoires = 0;
    protected $attaqueSpecialeDebloquee = false;

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
    }
    
    public function attaqueSpecialeKienzan($adversaire) {
        if ($this->attaqueSpecialeDebloquee) {
            if ($this->vie >= 10) {
                $this->vie -= 10;
                $adversaire->prendreDegats(20);
                echo $this->nom . " a lancé l'attaque spéciale Kienzan!" . PHP_EOL;
            } else {
                echo $this->nom . " n'a pas encore débloqué l'attaque spéciale Kienzan." . PHP_EOL;
            }
        }
    }

    public function attaqueSpecialeKamehameha($adversaire) {
        if ($this->attaqueSpecialeDebloquee) {
            if ($this->vie >= 30) {
                $this->vie -= 30;
                $adversaire->prendreDegats(60);
                echo $this->nom . " a lancé l'attaque spéciale Kienzan!" . PHP_EOL;
            }
        }
    }

    public function attaqueSpecialeGenkidama($adversaire) {
        if ($this->attaqueSpecialeDebloquee) {
            if ($this->vie >= 80) {
                $this->vie -= 80;
                $adversaire->prendreDegats(160);
                echo $this->nom . " a lancé l'attaque spéciale Kienzan!" . PHP_EOL;
            } else {
                echo $this->nom . " n'a pas suffisamment de vie pour utiliser l'attaque spéciale." . PHP_EOL;
            }
        }
    }


    public function attaqueSpeciale($adversaire) {
        if ($this->attaqueSpecialeDebloquee) {
            if ($this->vie >= 10) {
                $this->vie -= 10;
                $adversaire->prendreDegats(20);
                echo $this->nom . " a lancé l'attaque spéciale Kienzan!" . PHP_EOL;
            } else {
                echo $this->nom . " n'a pas suffisamment de vie pour utiliser l'attaque spéciale." . PHP_EOL;
            }
        } else {
            echo $this->nom . " n'a pas encore débloqué l'attaque spéciale Kienzan." . PHP_EOL;
        }
    }
    public function ameliorerPersonnage() {
        $this->victoires++;

        if ($this->victoires >= 1 && $this->victoires % 1 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Kienzan!" . PHP_EOL;
            $this->attaqueSpecialeDebloquee = true; // Assurez-vous d'utiliser l'attribut correct ici
            $this->puissance_attaque += 10;
        }

        if ($this->victoires >= 4 && $this->victoires % 4 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Kamehameha!" . PHP_EOL;
            $this->puissance_attaque += 30;
        }

        if ($this->victoires >= 9 && $this->victoires % 9 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Genkidama!" . PHP_EOL;
            $this->puissance_attaque += 80;
        }

        echo "Amélioration obtenue ! Choisissez ce que vous voulez améliorer :\n";
        $choixAmelioration = readline("Choisissez un bonus mystère en tapant 1 ou 2 : ");

        if ($choixAmelioration === '1') {
            $this->puissance_attaque = ceil($this->puissance_attaque + $this->puissance_attaque * .01);
        } elseif ($choixAmelioration === '2') {
            $this->vie = ceil($this->vie + $this->vie * .01);
        } else {
            echo "Choix non valide, aucune amélioration effectuée." . PHP_EOL;
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
    
    private $victoires = 0;
    public function afficherStatistiques($personnage) {
        echo $personnage->getNom() . " - Points de vie : " . $personnage->getVie() . " - Puissance d'attaque : " . $personnage->getPuissance_attaque() . PHP_EOL;
    }

    public function ameliorerPersonnage($vie, $puissance_attaque) {
        $this->victoires++;

        if ($this->victoires >= 1 && $this->victoires % 1 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Kienzan!" . PHP_EOL;
            $this->puissance_attaque += 10;
        }

        if ($this->victoires >= 4 && $this->victoires % 4 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Kamehameha!" . PHP_EOL;
            $this->puissance_attaque += 20;
        }

        if ($this->victoires >= 9 && $this->victoires % 9 === 0) {
            echo $this->getNom() . " a débloqué une nouvelle attaque : Genkidama!" . PHP_EOL;
            $this->puissance_attaque += 30;
        }

        echo "Amélioration obtenue ! Choisissez ce que vous voulez améliorer :\n";
        echo "1. Attaque (+2%)\n";
        echo "2. Vie (+2%)\n";
        $choixAmelioration = readline("Faites votre choix (1/2) : ");

        if ($choixAmelioration === '1') {
            $this->puissance_attaque = ceil($this->puissance_attaque * 1.02);
        } elseif ($choixAmelioration === '2') {
            $this->vie = ceil($this->vie * 1.02);
        } else {
            echo "Choix non valide, aucune amélioration effectuée." . PHP_EOL;
        }
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

            echo "Actions possibles : (1) Attaque normale, (2) Attaque spéciale, (3) Fuir" . PHP_EOL;
            $action = readline("Choisissez une action (1/2/3/4) : ");

            switch ($action) {
                case "1":
                    $heros->attaque($vilain);
                    echo $heros->getNom() . " a attaqué " . $vilain->getNom() . " avec une attaque normale!" . PHP_EOL;
                    break;
                case "2":
                    $heros->attaqueSpeciale($vilain);
                    break;
                case "3":
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
            $this->victoires++;
            if ($this->victoires >= 10) {
                echo "Félicitations ! Vous avez gagné le jeu en obtenant 10 victoires !" . PHP_EOL;
                exit();
            }
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
        echo "Sauvegarde supprimée avec succès !" . PHP_EOL;
    } else {
        echo "Aucune sauvegarde trouvée !" . PHP_EOL;
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
    echo "3. Statistiques des ennemis vaincus" . PHP_EOL;
    echo "4. Soigner et continuer" . PHP_EOL;
    echo "5. Règles" . PHP_EOL;
    echo "6. Quitter" . PHP_EOL;

    $choix = readline("Faites votre choix (1/2/3/4/5) : ");

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
            
            $game->saveGameState($player);        
            
            $game = new DragonBallGame('dragon_ball_save.json', $player);
            $game->loadGameState();
            
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
            if ($player->estVivant()) {
                $player->prendreDegats(-10);
            }
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
                    if ($player->estVivant()) {
                        $player->prendreDegats(-10);
                        $player->ameliorerPersonnage(); 
                    }
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
                echo "Statistiques des ennemis vaincus :" . PHP_EOL;
                foreach ($defeatedEnemies as $enemy) {
                    echo "Combat n°$i - $enemy" . PHP_EOL;
                    $i++;
                }
            } else {
                echo "Aucun ennemi vaincu pour le moment." . PHP_EOL;
            }
            break;

            case '4':
                if ($player !== null) {
                    $player->prendreDegats(-50); // Vous pouvez ajuster le montant de soins ici
                    $game->saveGameState($player);
                    echo "Vous avez été soigné et êtes prêt à continuer le combat." . PHP_EOL;
                    sleep(2);
                    echo "Veuillez sélectionner charger une partie pour continuer." . PHP_EOL;
                    sleep(3);
                } else {
                    echo "Aucune partie sauvegardée trouvée." . PHP_EOL;
                }
                break;
            case '5':
                // Règles du jeu
                echo "Test" . PHP_EOL;
                $regle = readline("Appuyez-sur Q pour quitter la page des règles du jeu ");
                if($regle == "Q" || $regle == "q")
                {
                    echo "Vous allez quitté la page des règles du jeu." . PHP_EOL;
                    sleep(3);
                    break;
                }
                else{
                    while($regle != "Q" || $regle != "q"){
                        echo "Vous n'avez pas appuyé sur Q." . PHP_EOL;
                        sleep(3);
                        $regle = readline("Appuyez-sur Q pour quitter la page des règles du jeu ");
                        if($regle == "Q" || $regle == "q")
                        {
                            echo "Vous allez quitté la page des règles du jeu." . PHP_EOL;
                            sleep(3);
                            break;
                        }
                    }
                }
        case '6':
            exit();
            break;

        default:
            echo "Choix non valide. Veuillez choisir une option valide (1/2/3/4/5)." . PHP_EOL;
            break;
    }
}
?>
// Path: RETTAB_Yanis_VERSAYO_Franklin_BTC2.25.1-php-Examen/README.md
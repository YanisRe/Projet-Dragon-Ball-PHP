<?php 
public function menu(){
    echo "Bienvenue dans le monde de Dragon Ball ! " . PHP_EOL;
    echo "Veuillez choisir une action : p pour jouer ou q pour quitter." . PHP_EOL;
    $action = readline();
    switch ($action):
        case "p":
            synopsis();
            break;
        case "q":
            echo "Vous avez quitté le jeu, à bientôt !";
            break;
        default:
            echo "Veuillez choisir une action valide." . PHP_EOL;
            $action = readline();
            break;
    endswitch;
}

echo "test\nwaw\ncliclic\n";
echo "test" . PHP_EOL . "waw" . PHP_EOL . "cliclic" . PHP_EOL;

?>
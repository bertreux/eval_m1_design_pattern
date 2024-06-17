<?php

require_once (dirname(__FILE__) . '\..\Classes\Archer.php');
require_once (dirname(__FILE__) . '\..\Classes\Guerrier.php');
require_once (dirname(__FILE__) . '\..\Classes\Mage.php');

require_once (dirname(__FILE__) . '\..\..\Attaques\Strategies\Archer\BowAttack.php');
require_once (dirname(__FILE__) . '\..\..\Attaques\Strategies\Guerrier\SwordAttack.php');
require_once (dirname(__FILE__) . '\..\..\Attaques\Strategies\Mage\MagicAttack.php');

class CharacterFactory
{
    public function createArcher() {
        return new Archer(20, 5, 40, new BowAttack());
    }

    public function createGuerrier() {
        return new Guerrier(15, 10, 50, new SwordAttack());
    }

    public function createMage() {
        return new Mage(25, 3, 30, new MagicAttack());
    }

    public function createPlayerFronNameClasse($choixClasseUser, $joueur) {
        switch ($choixClasseUser) {
            case 'ARCHER':
                $joueur = $this->createArcher();
                break;
            case 'GUERRIER':
                $joueur = $this->createGuerrier();
                break;
            case 'MAGE':
                $joueur = $this->createMage();
                break;

        }
        return $joueur;
    }
}
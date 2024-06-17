<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once ('BuffAtkNormale.php');
require_once (dirname(__FILE__) . '\..\..\..\DialogueToUser\DialogueToUser.php');

class BuffAtkRare implements ArtefactInterface
{
    private $dialogue;

    public function __construct()
    {
        $this->dialogue = new DialogueToUser();
    }

    public function getTypeArtefact()
    {
        return "active";
    }

    public function useArtefact($var, $var2 = null)
    {
        /** @var Mage|Archer|Guerrier $var */
        $var->setAtk($var->getAtk() + 40);
        $this->dialogue->explicationArtefact("\nVous avez engmanter l'attaque de votre personnage, vous avez maintenant ".$var->getAtk()." d'attaques", 'yellow');
    }

    public function getNameArtefact()
    {
        return "epee divine";
    }

    public function getDescriptionArtefact()
    {
        return "Ameliore votre Attaque de 40 points d'attaques";
    }

    public function necessiteArtefact()
    {
        return [new BuffAtkNormale()];
    }
}
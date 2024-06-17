<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once ('BuffDefNormale.php');
require_once (dirname(__FILE__) . '\..\..\..\DialogueToUser\DialogueToUser.php');

class BuffDefRare implements ArtefactInterface
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
        $var->setDef($var->getDef() + 40);
        $this->dialogue->explicationArtefact("\nVous avez engmanter la defense de votre personnage, vous avez maintenant ".$var->getDef()." de defenses", 'yellow');
    }

    public function getNameArtefact()
    {
        return "Armure lourde";
    }

    public function getDescriptionArtefact()
    {
        return "Ameliore votre Defense de 40 points de defenses";
    }

    public function necessiteArtefact()
    {
        return [new BuffDefNormale()];
    }
}
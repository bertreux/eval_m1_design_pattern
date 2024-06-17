<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once (dirname(__FILE__) . '\..\..\..\Personnages\Classes\PersonnagesInterface.php');
require_once (dirname(__FILE__) . '\..\..\..\DialogueToUser\DialogueToUser.php');

class BuffAtkNormale implements ArtefactInterface
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
        $var->setAtk($var->getAtk() + 10);
        $this->dialogue->explicationArtefact("\nVous avez engmanter l'attaque de votre personnage, vous avez maintenant ".$var->getAtk()." d'attaques", 'yellow');
    }

    public function getNameArtefact()
    {
        return "gant force +4";
    }

    public function getDescriptionArtefact()
    {
        return "Ameliore votre Attaque de 10 points d'attaques";
    }

    public function necessiteArtefact()
    {
        return [];
    }
}
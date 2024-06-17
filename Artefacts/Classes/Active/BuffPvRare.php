<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once ('BuffPvNormale.php');
require_once (dirname(__FILE__) . '\..\..\..\DialogueToUser\DialogueToUser.php');

class BuffPvRare implements ArtefactInterface
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
        $var->setMaxPvInitiale($var->getMaxPvInitiale() + 70);
        $this->dialogue->explicationArtefact("\nVous avez engmanter vos points de vie de votre personnage, vous avez maintenant ".$var->getPv()." points de vie", 'yellow');
    }

    public function getNameArtefact()
    {
        return "Anneau de resistance";
    }

    public function getDescriptionArtefact()
    {
        return "Ameliore vos points de vie de 70 points";
    }

    public function necessiteArtefact()
    {
        return [new BuffPvNormale()];
    }
}
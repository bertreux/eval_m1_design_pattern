<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once ('DownDefOfEnnemies.php');

class GoThroughDefEnnemies implements ArtefactInterface
{

    public function getTypeArtefact()
    {
        return "passive";
    }

    public function useArtefact($var, $var2 = null)
    {
        /** @var Ennemies $var */
        $var->def = 0;
    }

    public function getNameArtefact()
    {
        return "Arme fantome";
    }

    public function getDescriptionArtefact()
    {
        return "Passe a travers la defence des ennemies (ignore leur defense)";
    }

    public function necessiteArtefact()
    {
        return [new DownDefOfEnnemies()];
    }
}
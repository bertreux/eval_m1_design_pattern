<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');

class DownDefOfEnnemies implements ArtefactInterface
{

    public function getTypeArtefact()
    {
        return "passive";
    }

    public function useArtefact($var, $var2 = null)
    {
        /** @var Ennemies $var */
        $var->def -= 10;
        if($var->def < 0) {
            $var->def = 0;
        }
    }

    public function getNameArtefact()
    {
        return "Attaque corosive";
    }

    public function getDescriptionArtefact()
    {
        return "Baisse de 10 points la defence des ennemies";
    }

    public function necessiteArtefact()
    {
        return [];
    }
}
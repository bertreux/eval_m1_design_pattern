<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');
require_once ('AnnuleResistAttack.php');

class MakeEfficaceAttack implements ArtefactInterface
{

    public function getTypeArtefact()
    {
        return "passive";
    }

    public function useArtefact($var, $var2 = null)
    {
        $typeAttaque = "";
        /** @var Ennemies $var */
        switch ($var2) {
            case "Mage":
                $typeAttaque = "magic";
                break;
            case "Archer":
                $typeAttaque = "distance";
                break;
            case "Guerrier":
                $typeAttaque = "melee";
                break;
        }

        if (!in_array($typeAttaque, $var->efficace)) {
            $var->efficace[] = $typeAttaque;
        }

    }

    public function getNameArtefact()
    {
        return "Chaine d'affaiblissement";
    }

    public function getDescriptionArtefact()
    {
        return "Rend efficace l'attaque vers le type preferer de ton personnage (ex : pour mage, rend efficace sur attaque magique)";
    }

    public function necessiteArtefact()
    {
        return [new AnnuleResistAttack()];
    }
}
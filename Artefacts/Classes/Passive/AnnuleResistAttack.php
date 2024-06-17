<?php

require_once (dirname(__FILE__) . '\..\ArtefactInterface.php');

class AnnuleResistAttack implements ArtefactInterface
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


        $filteredArray = array_filter($var->resistant, function($value) use ($typeAttaque) {
            return $value !== $typeAttaque;
        });

        $var->resistant = array_values($filteredArray);
    }

    public function getNameArtefact()
    {
        return "Forte aura";
    }

    public function getDescriptionArtefact()
    {
        return "Annule la resistance envers le type preferer de ton personnage (ex : pour mage, enleve resiste sur attaque magique)";
    }

    public function necessiteArtefact()
    {
        return [];
    }
}
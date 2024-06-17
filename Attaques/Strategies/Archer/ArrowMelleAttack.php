<?php

require_once (dirname(__FILE__) . '\..\AttackStrategy.php');

class ArrowMelleAttack implements AttackStrategy
{
    private $typeAttaque;
    private $degat;
    private $nom;

    public function __construct()
    {
        $this->typeAttaque = 0;
        $this->degat = 0;
        $this->nom = "Coup de fleche";
    }

    public function getTypeAttaque()
    {
        return $this->typeAttaque;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDegat()
    {
        return $this->degat;
    }
}
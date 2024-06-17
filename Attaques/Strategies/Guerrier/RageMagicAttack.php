<?php

require_once (dirname(__FILE__) . '\..\AttackStrategy.php');

class RageMagicAttack implements AttackStrategy
{
    private $typeAttaque;
    private $degat;
    private $nom;

    public function __construct()
    {
        $this->typeAttaque = "magic";
        $this->degat = 0;
        $this->nom = "Attaque Berserk";
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
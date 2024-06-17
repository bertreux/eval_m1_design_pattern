<?php

require_once (dirname(__FILE__) . '\..\AttackStrategy.php');

class SwordAttack implements AttackStrategy
{
    private $typeAttaque;
    private $degat;
    private $nom;

    public function __construct()
    {
        $this->typeAttaque = "melee";
        $this->degat = 0;
        $this->nom = "Coup d'epee";
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
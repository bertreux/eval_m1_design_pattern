<?php

require_once (dirname(__FILE__) . '\..\AttackStrategy.php');

class ThrowAttack
{
    private $typeAttaque;
    private $degat;
    private $nom;

    public function __construct()
    {
        $this->typeAttaque = "distance";
        $this->degat = 0;
        $this->nom = "Lancer d'arme";
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
<?php

require_once 'EnnemiesBuilderInterface.php';
require_once (dirname(__FILE__) . '\..\Classes\Ennemies.php');

class EnnemiesBuilder implements EnnemiesBuilderInterface
{
    private $ennemi;

    public function __construct()
    {
        $this->reset();
    }


    public function reset()
    {
        $this->ennemi = new Ennemies();
    }

    public function getResult()
    {
        $result = $this->ennemi;
        $this->reset();

        return $result;
    }

    public function setName($name)
    {
        $this->ennemi->name = $name;
    }

    public function setPv($pv)
    {
        $this->ennemi->pv = $pv;
    }

    public function setDef($def)
    {
        $this->ennemi->def = $def;
    }

    public function setAtk($atk)
    {
        $this->ennemi->atk = $atk;
    }

    public function setEfficace($typeAttaque)
    {
        $this->ennemi->efficace = $typeAttaque;
    }

    public function setResistant($typeAttaque)
    {
        $this->ennemi->resistant = $typeAttaque;
    }
}
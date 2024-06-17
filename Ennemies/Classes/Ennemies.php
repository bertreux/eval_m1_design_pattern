<?php

require_once (dirname(__FILE__) . '\..\..\DialogueToUser\DialogueToUser.php');

class Ennemies
{
    public $name;
    public $pv;
    public $def;
    public $atk;
    public $efficace = [];
    public $resistant = [];
    private $dialogue;

    public function __construct()
    {
        $this->dialogue = new DialogueToUser();
    }

    public function takeDamage($atk, $typeAttaque) {
        if(in_array($typeAttaque, $this->efficace)) {
            $atk += 10;
            $this->dialogue->textEfficaceMonstre();
        } else if (in_array($typeAttaque, $this->resistant)) {
            $atk -= 10;
            $this->dialogue->textResistanceMonstre();
        }
        if(rand(1, 20) == 3) {
            $this->dialogue->coupCritiqueSurPlayer();
            $atk += 5;
        }
        $atk -= $this->def;
        if($atk <= 0) {
            $atk = 1;
        }
        $this->pv -= $atk;
        if($this->pv < 0) {
            $this->pv = 0;
        }
        return $atk;
    }
}
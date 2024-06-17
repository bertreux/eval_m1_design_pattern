<?php

require_once 'PersonnagesInterface.php';
require_once (dirname(__FILE__) . '\..\..\Attaques\Strategies\AttackStrategy.php');
require_once (dirname(__FILE__) . '\..\..\DialogueToUser\DialogueToUser.php');

class Guerrier implements PersonnagesInterface
{
    private $pv;
    private $def;
    private $atk;
    private $attaqueStrategy;
    private $classe;
    private $maxPvInitiale;
    private $dialogue;

    public function __construct($atk, $def, $pv, AttackStrategy $attaqueStrategy)
    {
        $this->atk = $atk;
        $this->def = $def;
        $this->pv = $pv;
        $this->attaqueStrategy = $attaqueStrategy;
        $this->classe = "Guerrier";
        $this->maxPvInitiale = $pv;
        $this->dialogue = new DialogueToUser();
    }

    public function attaqueDamage()
    {
        return $this->attaqueStrategy->getDegat();
    }

    public function attaqueNom()
    {
        return $this->attaqueStrategy->getNom();
    }

    public function getAttaqueAndStatDegat()
    {
        return ($this->attaqueStrategy->getDegat() + $this->atk);
    }

    public function typeAttaque()
    {
        return $this->attaqueStrategy->getTypeAttaque();
    }

    public function heal()
    {
        $newPv = $this->pv + 40;
        if($newPv > $this->maxPvInitiale) {
            $newPv = $this->maxPvInitiale;
        }
        $this->pv = $newPv;
        return $this->pv;
    }

    public function takeDamage($atk)
    {
        if(rand(1, 20) == 3)  {
            $this->dialogue->coupCritiqueSurMonstre();
            $atk += 5;
        }
        $atk -= $this->def;
        if($atk <= 0) {
            $atk = 1;
        }
        $newPv = $this->pv - $atk;
        $this->pv = $newPv;
        if($this->pv < 0) {
            $this->pv = 0;
        }
        return $newPv;
    }

    /**
     * @return mixed
     */
    public function getPv()
    {
        return $this->pv;
    }

    /**
     * @param mixed $pv
     */
    public function setPv($pv)
    {
        $this->pv = $pv;
    }

    /**
     * @return mixed
     */
    public function getDef()
    {
        return $this->def;
    }

    /**
     * @param mixed $def
     */
    public function setDef($def)
    {
        $this->def = $def;
    }

    /**
     * @return mixed
     */
    public function getAtk()
    {
        return $this->atk;
    }

    /**
     * @param mixed $atk
     */
    public function setAtk($atk)
    {
        $this->atk = $atk;
    }

    /**
     * @return AttackStrategy
     */
    public function getAttaqueStrategy()
    {
        return $this->attaqueStrategy;
    }

    /**
     * @param AttackStrategy $attaqueStrategy
     */
    public function setAttaqueStrategy($attaqueStrategy)
    {
        $this->attaqueStrategy = $attaqueStrategy;
    }

    /**
     * @return mixed
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param mixed $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return mixed
     */
    public function getMaxPvInitiale()
    {
        return $this->maxPvInitiale;
    }

    /**
     * @param mixed $maxPvInitiale
     */
    public function setMaxPvInitiale($maxPvInitiale)
    {
        $this->maxPvInitiale = $maxPvInitiale;
    }
}
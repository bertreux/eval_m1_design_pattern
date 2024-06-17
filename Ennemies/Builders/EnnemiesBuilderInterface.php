<?php

interface EnnemiesBuilderInterface {
    public function reset();
    public function getResult();
    public function setName($name);
    public function setPv($pv);
    public function setDef($def);
    public function setAtk($atk);
    public function setEfficace($typeAttaque);
    public function setResistant($typeAttaque);
}

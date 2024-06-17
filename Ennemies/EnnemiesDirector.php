<?php

require_once 'Builders\EnnemiesBuilderInterface.php';

class EnnemiesDirector
{
    public function makeGoblin(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Goblin');
        $builder->setPv(20);
        $builder->setDef(3);
        $builder->setAtk(5);
        $builder->setEfficace(['melee', 'distance', 'magic']);
        return $builder->getResult();
    }

    public function makeTroll(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Troll');
        $builder->setPv(30);
        $builder->setDef(8);
        $builder->setAtk(10);
        $builder->setEfficace(['distance']);
        $builder->setResistant(['melee']);
        return $builder->getResult();
    }

    public function makeDragon(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Dragon');
        $builder->setPv(50);
        $builder->setDef(15);
        $builder->setAtk(20);
        $builder->setEfficace(['distance']);
        $builder->setResistant(['magic', 'melee']);
        return $builder->getResult();
    }

    public function makeSquelette(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Squelette');
        $builder->setPv(25);
        $builder->setDef(5);
        $builder->setAtk(8);
        $builder->setEfficace(['melee']);
        $builder->setResistant(['magic', 'distance']);
        return $builder->getResult();
    }

    public function makeGhost(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Fantome');
        $builder->setPv(30);
        $builder->setDef(10);
        $builder->setAtk(12);
        $builder->setEfficace(['magic', 'distance']);
        $builder->setResistant(['melee']);
        return $builder->getResult();
    }

    public function makeLiche(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Liche');
        $builder->setPv(40);
        $builder->setDef(12);
        $builder->setAtk(18);
        $builder->setEfficace(['melee', 'distance']);
        $builder->setResistant(['magic']);
        return $builder->getResult();
    }

    public function makeGriphon(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Griphon');
        $builder->setPv(35);
        $builder->setDef(10);
        $builder->setAtk(15);
        $builder->setEfficace(['distance', 'magic']);
        $builder->setResistant(['melee']);
        return $builder->getResult();
    }

    public function makeSlime(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Slime');
        $builder->setPv(15);
        $builder->setDef(2);
        $builder->setAtk(4);
        $builder->setResistant(['melee', 'distance', 'magic']);
        return $builder->getResult();
    }

    public function makeMinotaure(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Minotaure');
        $builder->setPv(45);
        $builder->setDef(14);
        $builder->setAtk(18);
        return $builder->getResult();
    }

    public function makeDemon(EnnemiesBuilderInterface $builder) {
        $builder->reset();
        $builder->setName('Demon');
        $builder->setPv(50);
        $builder->setDef(18);
        $builder->setAtk(22);
        $builder->setResistant(['melee', 'distance', 'magic']);
        return $builder->getResult();
    }
}
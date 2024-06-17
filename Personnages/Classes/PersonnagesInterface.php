<?php

interface PersonnagesInterface {
    public function heal();
    public function takeDamage($atk);
    public function typeAttaque();
    public function attaqueDamage();
    public function attaqueNom();
    public function getAttaqueAndStatDegat();
}
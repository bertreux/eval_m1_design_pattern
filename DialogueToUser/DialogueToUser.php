<?php

class DialogueToUser
{
    private $colors = [
        'black' => '0;30',
        'red' => '0;31',
        'green' => '0;32',
        'yellow' => '0;33',
        'blue' => '0;34',
        'magenta' => '0;35',
        'cyan' => '0;36',
        'white' => '0;37',
    ];
    public function textColor($string, $color) {
        return "\033[" . $color . "m" . $string . "\033[0m";
    }
    public function explicationJeux($nbEtage) {
        echo $this->textColor("Dans ce jeux vous aller devoir vaincre dix monstre différent dans une tour.
Un monstre par etage pour un total de ".$nbEtage." au total.\n
Pour gagner vous devez vaincre tous les monstres mais si vous mourrez avant vous perder", $this->colors['blue']);
    }

    public function choixPersonnage() {
        echo $this->textColor("\n\nVeuillez choisir une classe entre :
        - Guerrier (efficace en melee)
        - Mage (efficace en magie)
        - Archer (efficace a distance)
Pour choisir votre classe, taper le nom de la classe choisi : ",$this->colors['green']);
    }

    public function debutEtage($getEtageActuel, $monstreEtage, $joueur) {
        echo $this->textColor("\n\nVous arriver dans l'etage ".$getEtageActuel."
Vous arrivez devant un ".$monstreEtage->name."\nVous recuperer votre vie au debut de chaque etage, vous avez actuellement ".$joueur->getPv()." points de vie
Le monstre a ".$monstreEtage->pv." points de vie", $this->colors['blue']);
    }

    public function choixActionCombat() {
        echo $this->textColor("\n\nVous pouvez soit :
        - Attaquer
        - Soigner
Pour choisir votre action, taper le nom de l'action choisi : ", $this->colors['green']);
    }

    public function soin($nbPotion, $pvJoueur)
    {
        echo $this->textColor("\nVous choisissez d'utiliser une potion
Vous vous soigner de 15 pv et perder une potion
Il vous reste ".($nbPotion - 1)." potion(s)\nVous avez ".$pvJoueur." points de vie",$this->colors['blue']);
    }

    public function choixAttaque($attaqueMelle, $attaqueDistance, $attaqueMagic)
    {
        echo $this->textColor("\nVous devez choisir une attaque : 
        - (1) ".$attaqueMelle->getNom()." (melee)
        - (2) ".$attaqueDistance->getNom()." (distance)
        - (3) ".$attaqueMagic->getNom()." (magic)
Pour choisir votre attaque, taper le numero de l'attaque correspondant :", $this->colors['green']);
    }

    public function soinImpossible()
    {
        echo $this->textColor("\nIl ne vous reste plus de potion pour vous soigner", $this->colors['red']);
    }

    public function gameOver()
    {
        echo $this->textColor("\nVous avez succomber au monstre de la tour.\nGAME OVER", $this->colors['red']);
    }

    public function win()
    {
        echo $this->textColor("\nVous avez vaincu tous les monstres de la tour.\nVOUS AVEZ GAGNE",$this->colors['yellow']);
    }

    public function joueurAttaquer($pvAvantJoueur, $getPv, $monstre)
    {
        echo $this->textColor("\n\nLe ".$monstre->name." vous attaque et vous inflige ".($pvAvantJoueur - $getPv)." de degats;
Il vous reste ".$getPv." points de vie",$this->colors['red']);
    }

    public function monstreAttaquer($degat, $pvMonstre)
    {
        echo $this->textColor("\nVous avez inflige ".$degat." points de degat au monstre.
Il lui reste ".$pvMonstre." points de vie",$this->colors['cyan']);
        if($pvMonstre == 0) {
            echo $this->textColor("\nVous avez vaincu le monstre de cette etage",$this->colors['yellow']);
        }
    }

    public function chooseArtefact(array $threePossibleArtefact) {
        /** @var ArtefactInterface[] $threePossibleArtefact */
        echo $this->textColor("\nVous pouvez choisir un artefact entre les ".count($threePossibleArtefact)." artefacts suivants\n",$this->colors['green']);
        $i = 1;
        foreach($threePossibleArtefact as $artefact) {
            echo $this->textColor("        - (".$i.") ".$artefact->getNameArtefact()." : ".$artefact->getDescriptionArtefact()."\n",$this->colors['green']);
            $i++;
        }
        echo $this->textColor("Pour choisir votre artefact, taper le numero qui lui est associer :",$this->colors['green']);
    }

    public function explicationArtefact($string, $color = null)
    {
        if($color == null){
            echo $string;
        } else {
            echo $this->textColor($string, $this->colors[$color]);
        }
    }

    public function coupCritiqueSurMonstre()
    {
        echo $this->textColor("\nLe monstre a fais un coup critique", $this->colors['yellow']);
    }

    public function textEfficaceMonstre()
    {
        echo $this->textColor("\nVotre attaque est efficace contre se monstre", $this->colors['green']);
    }

    public function textResistanceMonstre()
    {
        echo $this->textColor("\nLe monstre est resistant a votre attaque",$this->colors['red']);
    }

    public function coupCritiqueSurPlayer()
    {
        echo $this->textColor("\nVous avez fais un coup critique",$this->colors['yellow']);
    }
}
<?php

class CreateHistoryOfRun
{
    private $pathFile;
    private $fileName;
    private $dateTime;

    public function __construct()
    {
        $this->pathFile = __DIR__ . "/../Files/";
        $this->dateTime =  date("Ymd_His");
        $this->fileName = $this->dateTime . ".php";
    }

    public function createHistoryFile($classePersonnage) {
        $file = fopen($this->pathFile . $this->fileName, "w");
        fwrite($file, "History de la partie du ".$this->dateTime."\n");
        fwrite($file, "Vous avez choissi la classe ".$classePersonnage."\n\n");
        fclose($file);
    }

    public function historyOfBattleWin($etage, $monstre, $nbTour, $pvJoueur) {
        $file = fopen($this->pathFile . $this->fileName, "a");
        fwrite($file, "Vous avez vaincu le ".$monstre->name." du ".$etage." en ".$nbTour." de tours\n");
        fwrite($file, "ils vous restait a la fin de ce combat ".$pvJoueur." points de vie\n\n");
        fclose($file);
    }

    public function historyOfBattleLoss($etage, $monstre, $nbTour) {
        $file = fopen($this->pathFile . $this->fileName, "w");
        fwrite($file, "Vous avez ete vaincu par le ".$monstre->name." du ".$etage." en ".$nbTour." de tours\n\n");
        fclose($file);
    }

    public function endOfGameWinning($nbEtages, $nbToursTataux) {
        $file = fopen($this->pathFile . $this->fileName, "a");
            fwrite($file, "Vous avez gagne et vaincu tous les monstres des ".$nbEtages." etages en ".$nbToursTataux." tours tataux \n");
        fclose($file);
    }

    public function endOfGameLoss($nbEtages, $nbToursTataux, $etage) {
        $file = fopen($this->pathFile . $this->fileName, "a");
        fwrite($file, "Vous avez perdu a l'etage ".$etage." sur ".$nbEtages." en ".$nbToursTataux." tours tataux \n");
        fclose($file);
    }

    public function choiceOfArtefact($artefact) {
        /** @var ArtefactInterface  $artefact */
        $file = fopen($this->pathFile . $this->fileName, "a");
        fwrite($file, "Vous avez choisi l'artefact : \n");
        fwrite($file, "   nom         : ".$artefact->getNameArtefact()."\n");
        fwrite($file, "   description : ".$artefact->getDescriptionArtefact()."\n\n");
        fclose($file);
    }
}

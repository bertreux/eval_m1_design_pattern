<?php

require_once 'Ennemies\EnnemiesDirector.php';
require_once 'Ennemies\Builders\EnnemiesBuilder.php';
require_once 'History\Classes\CreateHistoryOfRun.php';

class GameManager
{
    private static $instance = null;
    private $score = 0;
    private $etages = [];
    private $player;
    private $etageActuel = 0;
    private $nbPotion = 5;
    private $game;
    private $tourCombat = 0;
    private $suiteActionCombat = ['joueur', 'monstre'];
    private $tourTotaux = 0;
    private $acquiredArtefact = [];
    private $history;

    public function __construct()
    {
        $this->history = new CreateHistoryOfRun();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function reinitialiserInstance() {
        self::$instance = null;
    }

    public function getScore() {
        return $this->score;
    }

    public function setScore($score) {
        $this->score = $score;
    }

    public function nbEtageMax() {
        return count($this->etages);
    }

    public function initGameEtages() {
        $EnnemiesDirector = new EnnemiesDirector();
        $ennemiesBuilder = new EnnemiesBuilder();
        $this->etages = [
            $EnnemiesDirector->makeGoblin($ennemiesBuilder),
            $EnnemiesDirector->makeSlime($ennemiesBuilder),
            $EnnemiesDirector->makeGhost($ennemiesBuilder),
            $EnnemiesDirector->makeSquelette($ennemiesBuilder),
            $EnnemiesDirector->makeTroll($ennemiesBuilder),
            $EnnemiesDirector->makeLiche($ennemiesBuilder),
            $EnnemiesDirector->makeMinotaure($ennemiesBuilder),
            $EnnemiesDirector->makeGriphon($ennemiesBuilder),
            $EnnemiesDirector->makeDragon($ennemiesBuilder),
            $EnnemiesDirector->makeDemon($ennemiesBuilder)
        ];
    }

    /**
     * @return Mage
     */
    public function getPlayer() {
        return $this->player;
    }

    public function setPlayer($player) {
        $this->player = $player;
    }

    public function getEtageActuel() {
        return ($this->etageActuel + 1);
    }

    public function setEtageActuel($etage) {
        $this->etageActuel = $etage;
    }

    /**
     * @return Ennemies
     */
    public function getMonstreActuel() {
        return $this->etages[$this->etageActuel];
    }

    public function monterEtage() {
        $this->etageActuel += 1;
    }

    public function getNbPotion() {
        return $this->nbPotion;
    }

    public function useOnePotion() {
        $this->nbPotion -= 1;
    }

    public function startGame() {
        $this->game = true;
    }

    public function stopGame() {
        $this->game = false;
    }

    public function getGameStatus() {
        return $this->game;
    }

    public function changeTourCombat() {
        $this->tourCombat = ($this->tourCombat + 1) % count($this->suiteActionCombat);
        $this->tourTotaux++;
    }

    public function getWhosTurn() {
        return $this->suiteActionCombat[$this->tourCombat];
    }

    public function reinitTourCombat() {
        $this->tourCombat = 0;
    }

    public function getTourCombat() {
        return $this->tourCombat;
    }

    public function getTourTotaux() {
        return $this->tourTotaux;
    }

    public function getAcquiredArtefact() {
        return $this->acquiredArtefact;
    }

    public function addAcquiredArtefact($acquiredArtefact) {
        $this->acquiredArtefact[] = $acquiredArtefact;
    }

    public function getHistory() {
        return $this->history;
    }

}
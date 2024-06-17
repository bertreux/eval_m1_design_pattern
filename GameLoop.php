<?php

require_once 'GameManager.php';
require_once 'DialogueToUser\DialogueToUser.php';
require_once 'Personnages\Factories\CharacterFactory.php';
require_once 'Artefacts\Factory\ArtefactFactory.php';

require_once 'Attaques\Strategies\Mage\MagicAttack.php';
require_once 'Attaques\Strategies\Mage\PunchAttack.php';
require_once 'Attaques\Strategies\Mage\TelekinesisAttack.php';

require_once 'Attaques\Strategies\Archer\BowAttack.php';
require_once 'Attaques\Strategies\Archer\ArrowMelleAttack.php';
require_once 'Attaques\Strategies\Archer\ProjectilMagicAttack.php';

require_once 'Attaques\Strategies\Guerrier\SwordAttack.php';
require_once 'Attaques\Strategies\Guerrier\RageMagicAttack.php';
require_once 'Attaques\Strategies\Guerrier\ThrowAttack.php';

$dialogue = new DialogueToUser();

$artefactFactory = new ArtefactFactory();

$gameManager = GameManager::getInstance();
$gameManager->initGameEtages();

$dialogue->explicationJeux($gameManager->nbEtageMax());

$choixClasseUserNotValid = true;
$joueur = null;
$characterFactory = new CharacterFactory();
while($choixClasseUserNotValid) {
    $dialogue->choixPersonnage();
    $choixClasseUser = strtoupper(trim(fgets(STDIN)));
    $joueur = $characterFactory->createPlayerFronNameClasse($choixClasseUser, $joueur);
    if(!is_null($joueur)) {
        $choixClasseUserNotValid = false;
        $gameManager->setPlayer($joueur);
    }
}

($gameManager->getHistory())->createHistoryFile($gameManager->getPlayer()->getClasse());

if($gameManager->getPlayer()->getClasse() == "Mage") {
    $attaqueMagic = new MagicAttack();
    $attaqueMelee = new PunchAttack();
    $attaqueDistance = new TelekinesisAttack();
} else if ($gameManager->getPlayer()->getClasse() == "Archer") {
    $attaqueMagic = new ProjectilMagicAttack();
    $attaqueMelee = new ArrowMelleAttack();
    $attaqueDistance = new BowAttack();
} else {
    $attaqueMagic = new RageMagicAttack();
    $attaqueMelee = new SwordAttack();
    $attaqueDistance = new ThrowAttack();
}

$gameManager->startGame();

while($gameManager->getGameStatus()) {
    $gameManager->getPlayer()->setPv($gameManager->getPlayer()->getMaxPvInitiale());
    $dialogue->debutEtage($gameManager->getEtageActuel(), $gameManager->getMonstreActuel(), $gameManager->getPlayer());

    foreach ($gameManager->getAcquiredArtefact() as $artefact) {
        /** @var ArtefactInterface $artefact */
        if($artefact->getTypeArtefact() == "passive") {
            $artefact->useArtefact($gameManager->getMonstreActuel(), $gameManager->getPlayer()->getClasse());
        }
    }

    $gameManager->reinitTourCombat();
    while($gameManager->getPlayer()->getPv() > 0 && $gameManager->getMonstreActuel()->pv > 0) {
        if($gameManager->getWhosTurn() == 'joueur') {
            $choixActionUserNotValid = true;
            while ($choixActionUserNotValid) {
                $dialogue->choixActionCombat();
                $choixActionUser = strtoupper(trim(fgets(STDIN)));
                if (in_array($choixActionUser, array('ATTAQUER', 'SOIGNER'))) {
                    $choixActionUserNotValid = false;
                }
            }

            $nbPotion = $gameManager->getNbPotion();
            if ($choixActionUser == 'SOIGNER' && $nbPotion > 0) {
                $gameManager->useOnePotion();
                $gameManager->getPlayer()->heal();
                $dialogue->soin($nbPotion, $gameManager->getPlayer()->getPv());
            } else if ($choixActionUser == 'SOIGNER' && $nbPotion == 0) {
                $dialogue->soinImpossible();
            }

            $choixAttaqueUserNotValid = true;
            if ($choixActionUser == 'ATTAQUER' || $choixActionUser == 'SOIGNER' && $nbPotion == 0) {
                while ($choixAttaqueUserNotValid) {
                    $dialogue->choixAttaque($attaqueMelee, $attaqueDistance, $attaqueMagic);
                    $choixAttaqueUser = trim(fgets(STDIN));
                    if (in_array($choixAttaqueUser, array(1, 2, 3))) {
                        $choixAttaqueUserNotValid = false;

                        switch ($choixAttaqueUser) {
                            case 1:
                                $gameManager->getPlayer()->setAttaqueStrategy($attaqueMelee);
                                break;
                            case 2:
                                $gameManager->getPlayer()->setAttaqueStrategy($attaqueDistance);
                                break;
                            case 3:
                                $gameManager->getPlayer()->setAttaqueStrategy($attaqueMagic);
                                break;
                        }

                        $degat = $gameManager->getMonstreActuel()->takeDamage(
                            $gameManager->getPlayer()->getAttaqueAndStatDegat(),
                            $gameManager->getPlayer()->typeAttaque());

                        $dialogue->monstreAttaquer($degat, $gameManager->getMonstreActuel()->pv);

                    }
                }
            }
        } else {
            $pvAvantJoueur = $gameManager->getPlayer()->getPv();
            $gameManager->getPlayer()->takeDamage($gameManager->getMonstreActuel()->atk);
            $dialogue->joueurAttaquer($pvAvantJoueur, $gameManager->getPlayer()->getPv(), $gameManager->getMonstreActuel());
        }
        $gameManager->changeTourCombat();
    }

    if(
        $gameManager->getEtageActuel() < $gameManager->nbEtageMax() &&
        $gameManager->getPlayer()->getPv() > 0
    ) {
        ($gameManager->getHistory())->historyOfBattleWin($gameManager->getEtageActuel(),
            $gameManager->getMonstreActuel(),
            $gameManager->getTourCombat(),
            $gameManager->getPlayer()->getPv());

        $threePossibleArtefact = $artefactFactory->getThreeRandomAvailaibleArtefacts($gameManager->getAcquiredArtefact());

        if($threePossibleArtefact != []) {
            $choixArtefactNotValid = true;
            while ($choixArtefactNotValid) {
                $dialogue->chooseArtefact($threePossibleArtefact);
                $choiceArtefactUser = trim(fgets(STDIN));
                if ($choiceArtefactUser >= 1 && $choiceArtefactUser <= count($threePossibleArtefact)) {
                    $choixArtefactNotValid = false;
                }
            }


            /** @var ArtefactInterface $artefactChoisi */
            $artefactChoisi = $threePossibleArtefact[$choiceArtefactUser - 1];
            if ($artefactChoisi->getTypeArtefact() == "active") {
                $artefactChoisi->useArtefact($gameManager->getPlayer());
            }
            ($gameManager->getHistory())->choiceOfArtefact($artefactChoisi);
            $gameManager->addAcquiredArtefact($artefactChoisi);
        }

    }

    if($gameManager->getPlayer()->getPv() <= 0) {
        ($gameManager->getHistory())->historyOfBattleLoss($gameManager->getEtageActuel(),
            $gameManager->getMonstreActuel(),
            $gameManager->getTourCombat());
        ($gameManager->getHistory())->endOfGameLoss($gameManager->nbEtageMax(),
            $gameManager->getTourTotaux(),
            $gameManager->getEtageActuel());
        $dialogue->gameOver();
        $gameManager->stopGame();
    }

    if(($gameManager->getEtageActuel() + 1) > $gameManager->nbEtageMax()) {
        ($gameManager->getHistory())->endOfGameWinning($gameManager->nbEtageMax(), $gameManager->getTourTotaux());
        $dialogue->win();
        $gameManager->stopGame();
    }

    $gameManager->monterEtage();
}

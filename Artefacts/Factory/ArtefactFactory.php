<?php

require_once (dirname(__FILE__) . '/../Classes/Active/BuffAtkNormale.php');
require_once (dirname(__FILE__) . '/../Classes/Active/BuffAtkRare.php');
require_once (dirname(__FILE__) . '/../Classes/Active/BuffDefNormale.php');
require_once (dirname(__FILE__) . '/../Classes/Active/BuffDefRare.php');
require_once (dirname(__FILE__) . '/../Classes/Active/BuffPvNormale.php');
require_once (dirname(__FILE__) . '/../Classes/Active/BuffPvRare.php');

require_once (dirname(__FILE__) . '/../Classes/Passive/AnnuleResistAttack.php');
require_once (dirname(__FILE__) . '/../Classes/Passive/DownDefOfEnnemies.php');
require_once (dirname(__FILE__) . '/../Classes/Passive/GoThroughDefEnnemies.php');
require_once (dirname(__FILE__) . '/../Classes/Passive/MakeEfficaceAttack.php');

class ArtefactFactory
{
    private $artefacts = [];

    public function __construct()
    {
        $this->artefacts = [
            new BuffAtkNormale(),
            new BuffAtkRare(),
            new BuffDefNormale(),
            new BuffDefRare(),
            new BuffPvNormale(),
            new BuffPvRare(),
            new AnnuleResistAttack(),
            new DownDefOfEnnemies(),
            new GoThroughDefEnnemies(),
            new MakeEfficaceAttack()
        ];
    }

    public function getThreeRandomAvailaibleArtefacts($OwnedArtefact)
    {
        $listOfArtefactsToChoose = [];

        /** @var ArtefactInterface[] $OwnedArtefact */
        foreach ($this->artefacts as $artefact) {
            $requirements = $artefact->necessiteArtefact();

//            if (empty($requirements)) {
//                if (!in_array(get_class($artefact), array_map('get_class', $OwnedArtefact))) {
//                    $listOfArtefactsToChoose[] = $artefact;
//                }
//            } else {
                $isValid = true;
                foreach ($requirements as $requiredArtefact) {
                    if (!in_array(get_class($requiredArtefact), array_map('get_class', $OwnedArtefact))) {
                        $isValid = false;
                    }
                }
                if($isValid && !in_array(get_class($artefact), array_map('get_class', $OwnedArtefact))) {
                    $listOfArtefactsToChoose[] = $artefact;
                }
//            }
        }

        shuffle($listOfArtefactsToChoose);
        return array_slice($listOfArtefactsToChoose, 0, 3);
    }
}
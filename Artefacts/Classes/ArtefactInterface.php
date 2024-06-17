<?php

require_once (dirname(__FILE__) . '\..\..\Personnages\Classes\PersonnagesInterface.php');

interface ArtefactInterface {
    public function getTypeArtefact();
    public function useArtefact($var, $var2 = null);
    public function getNameArtefact();
    public function getDescriptionArtefact();
    public function necessiteArtefact();
}

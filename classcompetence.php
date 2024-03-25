<?php

class Competence {
    private $intitulePrincipal;
    private $details;
    private $langages = [];

    public function __construct($intitulePrincipal, $details) {
        $this->intitulePrincipal = $intitulePrincipal;
        $this->details = $details;
    }

    public function getIntitulePrincipal() {
        return $this->intitulePrincipal;
    }

    public function getDetails() {
        return $this->details;
    }

    public function ajouterLangage($langage) {
        $this->langages[] = $langage;
    }

    public function getLangages() {
        return $this->langages;
    }
}

?>
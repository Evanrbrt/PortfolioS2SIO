<?php

class Langage {
    private $intitule;

    public function __construct($intitule) {
        $this->intitule = $intitule;
    }

    public function getIntitule() {
        return $this->intitule;
    }
}


?>
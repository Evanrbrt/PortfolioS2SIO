<?php
class Projet {
    private $intitule;
    private $lien; // Ajoutez un attribut pour le lien
    private $competences = [];
    private $langages = [];

    public function __construct($intitule, $lien) { // Ajoutez le lien en paramètre du constructeur
        $this->intitule = $intitule;
        $this->lien = $lien; // Initialisez le lien
    }

    public function getIntitule() {
        return $this->intitule;
    }

    public function getLien() {
        return $this->lien; // Retournez le lien
    }

    public function ajouterCompetence($competence) {
        $this->competences[] = $competence;
    }

    public function getCompetences() {
        return $this->competences;
    }

    public function ajouterLangage($langage) {
        $this->langages[] = $langage;
    }

    public function getLangages() {
        return $this->langages;
    }
}
?>
<?php

namespace Entity;

class TypeQuestion {
    
    protected $idTypeQuestion;
    protected $libelleQuestion;
    protected $multiple;
    
    public function getIdTypeQuestion() {
        return $this->idTypeQuestion;
    }

    public function getLibelleQuestion() {
        return $this->libelleQuestion;
    }

    public function getMultiple() {
        return $this->multiple;
    }

    public function setIdTypeQuestion($idTypeQuestion) {
        $this->idTypeQuestion = $idTypeQuestion;
        return $this;
    }

    public function setLibelleQuestion($libelleQuestion) {
        $this->libelleQuestion = $libelleQuestion;
        return $this;
    }

    public function setMultiple($multiple) {
        $this->multiple = $multiple;
        return $this;
    }


    
}

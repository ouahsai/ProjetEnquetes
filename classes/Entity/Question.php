<?php

namespace Entity;

class Question {
    
    protected $idQuestion;
    protected $libelleQuestion;
    
    /**
     * 
     * @var Enquete
     */
    protected $idEnquete;
    
    /**
     * 
     * @var TypeQuestion
     */
    protected $idTypeQuestion;
    
    public function getIdQuestion() {
        return $this->idQuestion;
    }

    public function getLibelleQuestion() {
        return $this->libelleQuestion;
    }

    public function setIdQuestion($idQuestion) {
        $this->idQuestion = $idQuestion;
        return $this;
    }

    public function setLibelleQuestion($libelleQuestion) {
        $this->libelleQuestion = $libelleQuestion;
        return $this;
    }
    public function getIdEnquete() {
        return $this->idEnquete;
    }

    public function getIdTypeQuestion() {
        return $this->idTypeQuestion;
    }

    public function setIdEnquete(Enquete $idEnquete) {
        $this->idEnquete = $idEnquete;
        return $this;
    }

    public function setIdTypeQuestion(TypeQuestion $idTypeQuestion) {
        $this->idTypeQuestion = $idTypeQuestion;
        return $this;
    }



}

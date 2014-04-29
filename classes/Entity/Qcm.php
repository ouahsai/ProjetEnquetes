<?php

namespace Entity;

class Qcm {
    
    protected $idQcm;
    protected $valeurQcm;
    
    /**
     * 
     * @var Question
     */
    protected $idQuestion;
    
    public function getIdQcm() {
        return $this->idQcm;
    }

    public function getValeurQcm() {
        return $this->valeurQcm;
    }

    public function setIdQcm($idQcm) {
        $this->idQcm = $idQcm;
        return $this;
    }

    public function setValeurQcm($valeurQcm) {
        $this->valeurQcm = $valeurQcm;
        return $this;
    }

    public function getIdQuestion() {
        return $this->idQuestion;
    }

    public function setIdQuestion(Question $idQuestion) {
        $this->idQuestion = $idQuestion;
        return $this;
    }


    
    
}
